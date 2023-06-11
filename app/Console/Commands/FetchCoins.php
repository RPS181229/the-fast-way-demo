<?php

namespace App\Console\Commands;

use App\Models\Coin;
use App\Models\Platform;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchCoins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-coins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $coinUrl = 'https://api.coingecko.com/api/v3/coins/list?include_platform=true';
        $response = Http::get($coinUrl);

        if ($response->successful()) {
            $data = $response->json();

            $count = count($data);
            $percent = 0;
            echo "Coin list insertation started\n";
            foreach ($data as $key=>$coin) {
                $this->createCoin($coin);//create coins list in database

                // Log process % in console
                $newPercent = floor($key*100/$count);
                if ($newPercent>$percent) {
                    $percent = $newPercent;
                    echo "Processing: ". $percent."%\n";
                }
            }
            echo "Coin list insertation Ended\n";

        } else {
            // Handle the failed API request
            $statusCode = $response->status();
            $errorMessage = $response->body();

            Log::error([$statusCode, $errorMessage]);
            // Handle the error
        }
    }

    /**
     * Insert coins in database
     * $data =  [
     *           'id',
     *           'symbol',
     *            'name',
     *            'platforms' =>
     *                          [
     *                              ['name'=>'value']
     *                          ]
     *           ]
     *
    */
    private function createCoin($data)
    {
        Log::info($data);
        $coin = new Coin();
        $coin->coin_id = $data['id'];
        $coin->symbol = $data['symbol'];
        $coin->name = $data['name'];
        if ($coin->save()) {
            foreach ($data['platforms'] as $name => $value) {
                $platform = new Platform();
                $platform->coin_id = $coin->id;
                $platform->name = $name;
                $platform->value = $value;
                $platform->save();
            }
        }
    }
}