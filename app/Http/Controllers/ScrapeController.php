<?php

namespace App\Http\Controllers;
use Acme\Client;

use App\Services\WebScraper;


class ScrapeController extends Controller
{
    // private $result = array();
    public function scrape(WebScraper $scraper)
    {
        $data = $scraper->scrapeSudanGoldPrices();

        return response()->json($data);
    }
}
