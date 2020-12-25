<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Ranium\Fixerio\Client;

final class FixerioTest extends TestCase
{
    protected $fixerioApiKey;

    protected function setUp(): void
    {
        $this->fixerioApiKey = getenv('FIXERIO_API_KEY');
    }

    public function testCanBeCreatedFromAccessKey()
    {
        
        $this->assertInstanceOf(
            Client::class,
            Client::create($this->fixerioApiKey)
        );
    }

    public function testCanGetLatestRates()
    {
        $fixerio = Client::create($this->fixerioApiKey, false);

        $latestRates = $fixerio->latest();

        $this->assertFixerioResponse($latestRates);
    }

    public function testCanGetHistoricalRates()
    {
        $fixerio = Client::create($this->fixerioApiKey, false);

        $historicalRates = $fixerio->historical(
            [
                'date' => '2019-01-01',
            ]
        );

        $this->assertFixerioResponse($historicalRates);
    }

    private function assertFixerioResponse($response)
    {
        $this->assertTrue($response['success']);
        $this->assertIsArray($response['rates']);
    }
}