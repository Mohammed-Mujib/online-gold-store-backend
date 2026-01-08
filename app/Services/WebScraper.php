<?php

namespace App\Services;

// use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Arr;

class WebScraper
{
    protected HttpBrowser $browser;

    public function __construct()
    {
        $this->browser = new HttpBrowser(HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64)'
            ],
            'timeout' => 100
        ]));
    }

    public function scrapeSudanGoldPrices()
    {
        $url = 'https://sudan.goldpriceu.com/';

        $crawler = $this->browser->request('GET', $url);


        $prices = [];

        $crawler->filter('tbody.todaygoldprice tr')->each(function (Crawler $tr) use (&$prices) {

        // Skip rows that don't have 3 columns (ads, empty rows, etc.)
            if ($tr->filter('td')->count() < 3) {
                return;
            }

            $label = trim($tr->filter('td.maintd')->text());
            $sdg   = trim($tr->filter('td.auto-update')->eq(0)->text());
            $usd   = trim($tr->filter('td.auto-update')->eq(1)->text());

                  $karat = $this->extractKarat($label);
        $measurement = $this->extractMeasurement($label);

        $prices[] = [

                'label'        => $this->normalizeLabel($label),
                'karat'        => $karat,
                'measurement'  => $measurement,
                'price_sdg'    => $this->normalizePrice($sdg),
                'price_usd'    => $this->normalizePrice($usd),
        ];
        });

        return ["data" => $prices];
    }

    private function normalizePrice(string $price): float
    {
        return (float) str_replace(
            [',', 'SDG', '$', ' '],
            '',
            $price
        );
    }
    private function normalizeLabel(string $label): string
    {
        $key = 'gold';

        // Karat
        if (preg_match('/عيار\s*(\d+)/u', $label, $m)) {
            $key .= '_' . $m[1] . 'k';
        }

        // Weight (bars, coins)
        if (preg_match('/وزن\s*(\d+)\s*جرام/u', $label, $m)) {
            $key .= '_' . $m[1] . 'g';
        }

        // Type
        if (str_contains($label, 'جرام')) {
            $key .= '_gram';
        } elseif (str_contains($label, 'اونصة')) {
            $key .= '_ounce';
        } elseif (str_contains($label, 'سبيكة')) {
            $key .= '_bar';
        } elseif (str_contains($label, 'الجنية')) {
            $key .= '_coin';
        } elseif (str_contains($label, 'الكيلو')) {
            $key .= '_kg';
        } elseif (str_contains($label, 'طن')) {
            $key .= '_ton';
        }

        return strtolower($key);
    }
    private function extractKarat(string $label): ?int
{
    if (preg_match('/عيار\s*(\d+)/u', $label, $matches)) {
        return (int) $matches[1];
    }
    return null; // fallback if not found
}
    private function extractMeasurement(string $label): ?string
{
    if (preg_match('/وزن\s*(\d+)\s*جرام/u', $label, $matches)) {
        return $matches[1] . 'g';
    }

    if (str_contains($label, 'اونصة')) {
        return 'ounce';
    } elseif (str_contains($label, 'سبيكة')) {
        return 'bar';
    } elseif (str_contains($label, 'الجنية')) {
        return 'coin';
    } elseif (str_contains($label, 'الكيلو')) {
        return 'kg';
    } elseif (str_contains($label, 'طن')) {
        return 'ton';
    } elseif (str_contains($label, 'جرام')) {
        return 'gram';
    }

    return "gram"; // fallback if no match
}

    protected function getPrice(Crawler $crawler, string $selector): ?float
    {
        if (! $crawler->filter($selector)->count()) {
            return null;
        }

        return (float) trim($crawler->filter($selector)->text());
    }

}