<?php

namespace App\Http\Controllers;
use Acme\Client;

use App\Services\WebScraper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ScrapeController extends Controller
{
    // private $result = array();
    public function scrape(WebScraper $scraper)
    {
        $data = $scraper->scrapeSudanGoldPrices();

        return response()->json($data);
    }
    // public function __invoke(WebScraper $service)
    // {
    //     return response()->json(
    //         $service->scrapeSudanGoldPrices()
    //     );
    // }
}
