<?php

namespace App\Http\Controllers;
use Acme\Client;

use App\Services\WebScraper;


class ScrapeController extends Controller
{
    // private $result = array();
    public function scrape(WebScraper $scraper)
    {
        // $data = $scraper->scrapeSudanGoldPrices();
        $data = [
            "data" =>[
                        [
                        "label"=> "gold_24k",
                        "karat"=> 24,
                        "measurement"=> "gram",
                        "price_sdg"=> 85538.62,
                        "price_usd"=> 142.21
                        ],
                        [
                        "label"=> "gold_22k",
                        "karat"=> 22,
                        "measurement"=> "gram",
                        "price_sdg"=> 78410.4,
                        "price_usd"=> 130.36
                        ],
                        [
                        "label"=> "gold_21k",
                        "karat"=> 21,
                        "measurement"=> "gram",
                        "price_sdg"=> 74846.29,
                        "price_usd"=> 124.43
                        ],
                        [
                        "label"=> "gold_18k",
                        "karat"=> 18,
                        "measurement"=> "gram",
                        "price_sdg"=> 64153.97,
                        "price_usd"=> 106.66
                        ],
                        [
                        "label"=> "gold_14k",
                        "karat"=> 14,
                        "measurement"=> "gram",
                        "price_sdg"=> 49897.53,
                        "price_usd"=> 82.96
                        ],
                        [
                        "label"=> "gold_12k",
                        "karat"=> 12,
                        "measurement"=> "gram",
                        "price_sdg"=> 42769.31,
                        "price_usd"=> 71.11
                        ],
                        [
                        "label"=> "gold_10k",
                        "karat"=> 10,
                        "measurement"=> "gram",
                        "price_sdg"=> 35641.09,
                        "price_usd"=> 59.25
                        ],
                        [
                        "label"=> "gold_9k",
                        "karat"=> 9,
                        "measurement"=> "gram",
                        "price_sdg"=> 32076.98,
                        "price_usd"=> 53.33
                        ],
                        [
                        "label"=> "gold_24k_ounce",
                        "karat"=> 24,
                        "measurement"=> "ounce",
                        "price_sdg"=> 2660548.5,
                        "price_usd"=> 4423.23
                        ],
                        [
                        "label"=> "gold_21k_ounce",
                        "karat"=> 21,
                        "measurement"=> "ounce",
                        "price_sdg"=> 2327979.84,
                        "price_usd"=> 3870.21
                        ],
                        [
                        "label"=> "gold_21k_8g_gram",
                        "karat"=> 21,
                        "measurement"=> "8g",
                        "price_sdg"=> 598770.32,
                        "price_usd"=> 995.44
                        ],
                        [
                        "label"=> "gold_24k_250g_gram",
                        "karat"=> 24,
                        "measurement"=> "250g",
                        "price_sdg"=> 21384655,
                        "price_usd"=> 35552.5
                        ],
                        [
                        "label"=> "gold_24k_100g_gram",
                        "karat"=> 24,
                        "measurement"=> "100g",
                        "price_sdg"=> 8553862,
                        "price_usd"=> 14221
                        ],
                        [
                        "label"=> "gold_24k_50g_gram",
                        "karat"=> 24,
                        "measurement"=> "50g",
                        "price_sdg"=> 4276931,
                        "price_usd"=> 7110.5
                        ],
                        [
                        "label"=> "gold_24k_kg",
                        "karat"=> 24,
                        "measurement"=> "kg",
                        "price_sdg"=> 85538620,
                        "price_usd"=> 142210
                        ],
                        [
                        "label"=> "gold_21k_kg",
                        "karat"=> 21,
                        "measurement"=> "kg",
                        "price_sdg"=> 74846290,
                        "price_usd"=> 124430
                        ],
                        [
                        "label"=> "gold_24k_ton",
                        "karat"=> 24,
                        "measurement"=> "ton",
                        "price_sdg"=> 9999999999.99,
                        "price_usd"=> 142210000
                        ],
                        [
                        "label"=> "gold_21k_ton",
                        "karat"=> 21,
                        "measurement"=> "ton",
                        "price_sdg"=> 74846290000,
                        "price_usd"=> 124430000
                        ]
                    ]
                        ];

        return response()->json($data);


    }
}
