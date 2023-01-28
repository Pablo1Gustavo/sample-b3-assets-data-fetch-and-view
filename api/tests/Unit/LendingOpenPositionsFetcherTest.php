<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Jobs\LendingOpenPositionsFetcher;

class LendingOpenPositionsFetcherTest extends TestCase
{
    private $job;
    private $previousDate;

    public function setUp(): void
    {
        parent::setUp();

        $this->previousDate = date('Y-m-d',strtotime("-2 days"));
        $this->job = new LendingOpenPositionsFetcher();
    }

    function test_get_fetch_url()
    {
        $date = $this->previousDate;
        $expectedUrl = 'https://arquivos.b3.com.br/api/download/requestname?fileName=LendingOpenPosition&date='.$date;

        $url = $this->job->getFetchUrl($date);

        $this->assertSame($expectedUrl, $url);
    }

    function test_get_download_token()
    {
        $token = $this->job->getDownloadToken($this->previousDate);

        $this->assertTrue(base64_decode($token, true) !== false);
    }

    function test_get_data()
    {
        $token = $this->job->getDownloadToken($this->previousDate);

        $data = $this->job->getData($token);

        $expectedArray = ["RptDt", "TckrSymb", "ISIN", "Asst", "BalQty", "TradAvrgPric", "PricFctr", "BalVal"];

        $this->assertEquals($expectedArray, array_keys($data[0]));
    }

    function test_get_data_with_custom_headers()
    {
        $token = $this->job->getDownloadToken($this->previousDate);

        $customHeaders = ['date', 'ticker_symbol', 'isin', 'ticker_symbol_abrv', 'balance_amount', 'average_price', 'price_factor', 'total_balance'];

        $data = $this->job->getData($token, $customHeaders);

        $this->assertEquals($customHeaders, array_keys($data[0]));
    }
}
