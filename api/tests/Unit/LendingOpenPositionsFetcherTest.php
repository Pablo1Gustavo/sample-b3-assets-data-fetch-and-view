<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Jobs\LendingOpenPositionsFetcher;

class LendingOpenPositionsFetcherTest extends TestCase
{
    private $job;

    public function setUp(): void
    {
        parent::setUp();

        $previousDate = date('Y-m-d',strtotime("-3 days"));
        $this->job = new LendingOpenPositionsFetcher($previousDate);
    }

    function test_get_fetch_url()
    {
        $previousDate = date('Y-m-d',strtotime("-3 days"));
        $expectedUrl = 'https://arquivos.b3.com.br/api/download/requestname?fileName=LendingOpenPosition&date='.$previousDate;

        $url = $this->job->getFetchUrl();

        $this->assertSame($expectedUrl, $url);
    }

    function test_get_download_token()
    {
        $token = $this->job->getDownloadToken();

        $this->assertTrue(base64_decode($token, true) !== false);
    }

    public function test_set_date()
    {
        $this->job->setDate('1970-01-01');

        $this->assertEquals($this->job->getDate(), '1970-01-01');
    }

    function test_get_download_token_for_tomorrow()
    {
        $tomorrowDate = date('Y-m-d',strtotime("+1 day"));
        $this->job->setDate($tomorrowDate);

        $token = $this->job->getDownloadToken();

        $this->assertNull($token);
    }

    function test_get_data()
    {
        $token = $this->job->getDownloadToken();

        $data = $this->job->getData($token);

        $expectedArray = ["RptDt", "TckrSymb", "ISIN", "Asst", "BalQty", "TradAvrgPric", "PricFctr", "BalVal"];

        $this->assertEquals($expectedArray, array_keys($data[0]));
    }

    function test_get_data_with_custom_headers()
    {
        $token = $this->job->getDownloadToken();

        $customHeaders = ['date', 'ticker_symbol', 'isin', 'ticker_symbol_abrv', 'balance_amount', 'average_price', 'price_factor', 'total_balance'];

        $data = $this->job->getData($token, $customHeaders);

        $this->assertEquals($customHeaders, array_keys($data[0]));
    }
}
