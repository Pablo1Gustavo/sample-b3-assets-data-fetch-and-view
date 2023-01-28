<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class LendingOpenPositionsFetcher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $apiUrl = 'https://arquivos.b3.com.br/api';

    public function getFetchUrl(string $date): string
    {
        return $this->apiUrl.'/download/requestname?fileName=LendingOpenPosition&date='.$date;
    }

    public function getDownloadToken(string $date): string
    {
        $response = Http::get($this->getFetchUrl($date));

        $data = json_decode($response->body(), true);

        return $data['token'];
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

    public function handle()
    {
        //
    }
}
