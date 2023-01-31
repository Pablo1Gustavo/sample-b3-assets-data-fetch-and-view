<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\TickerSymbol;
use App\Models\LendingOpenPosition;

class LendingOpenPositionsFetcher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $apiUrl = 'https://arquivos.b3.com.br/api';
    private string $date;

    private array $customHeaders = [
        'date',
        'ticker_symbol',
        'isin',
        'ticker_symbol_abrv',
        'balance_amount',
        'average_price',
        'price_factor',
        'total_balance'
    ];

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getFetchUrl(): string
    {
        return $this->apiUrl.'/download/requestname?fileName=LendingOpenPosition&date='.$this->date;
    }

    public function getDownloadToken(): string | null
    {
        $response = Http::get($this->getFetchUrl());

        if ($response->getStatusCode() != 200) return null;

        $data = json_decode($response->body(), true);

        return $data['token'];
    }

    public function getLastAvaliableToken(int $daysInterval = 30): string | null
    {
        for ($day = 0; $day <= $daysInterval; $day++)
        {
            $this->setDate(date('Y-m-d', strtotime("-".$day." days")));
            
            $token = $this->getDownloadToken();

            if ($token != null) return $token;
        }

        return null;
    }

    public function getData(string $token, array $customHeaders = null): array
    {
        $response = Http::get($this->apiUrl.'/download?token='.$token);

        $csvString = str_replace("\r", "", $response->body());
        $csvLines = explode("\n", $csvString);

        $headers = null;

        $data = [];

        foreach ($csvLines as $line)
        {
            if (is_null($headers)) 
            {
                $headers = $customHeaders ?? explode(";", $line);
            }
            else if (!empty($line))
            {
                $data[] = array_combine($headers, explode(";", $line));
            }
        }

        return $data;
    }

    private function addUnexistingTickerSymbols(array $data): void
    {
        $tickerSymbols = collect($data)->map(
            fn ($item) => $item[$this->customHeaders[1]]
        );

        $existingTickerSymbols = TickerSymbol::all()->pluck('id','name');

        $missingTickerSymbols = $tickerSymbols->filter(
            fn ($item) => !$existingTickerSymbols->has($item)
        )->map(
            fn($name) => ['name' => $name]
        );
        
        TickerSymbol::insert($missingTickerSymbols->toArray());
    }

    // Requires add unexisting ticker symbols before
    private function addLendingOpenPositions(array $data): void
    {
        $lendingOpenPositions = [];

        $existingTickerSymbols = TickerSymbol::all()->pluck('id','name');

        forEach ($data as $item)
        {
            $lendingOpenPositions[] = [
                'date'              => $item['date'],
                'ticker_symbol_id'  => $existingTickerSymbols[$item['ticker_symbol']],
                'balance_amount'    => $item['balance_amount'],
                'average_price'     => str_replace(",", ".", $item['average_price']),
                'total_balance'     => str_replace(",", ".", $item['total_balance'])
            ];
        }

        LendingOpenPosition::insert($lendingOpenPositions);
    }

    public function handle(): void
    {
        if (LendingOpenPosition::dateExists($this->date)) return;

        $token = $this->getDownloadToken();

        if (is_null($token)) return;
        
        $data = $this->getData($token, $this->customHeaders);

        $this->addUnexistingTickerSymbols($data);
        $this->addLendingOpenPositions($data);
    }
}
