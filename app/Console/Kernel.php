<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers;
use App\Models\Crypto;
use App\Models\Cryptoorder;
use Scngnr\Mdent\Binance\BinanceClient;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        ini_set ( 'max_execution_time', -1);

        // @see home_directory_config.php
        // use config from ~/.confg/jaggedsoft/php-binance-api.json
        $api = new BinanceClient('IUSTUlCe8f74A4F0gmx0OqXlbe3ZKDu7wg0eI6WQNxbzv1EAK8QgV8F4zhr1EpBe', 'yO2rd9C88FQXaH6L7hbXvmksLwspYKbLrE5ACy2vzEz41v1CySPJ3RpGVjHcCU4I');

        $market = $api->Margin->marketPrice();
        // echo "<pre>";
        // print_r($market);

        for ($i=0; $i < count($market); $i++) {

          $checkCrypto = Crypto::where('symbol', $market[$i]['symbol'])->first();
          if($checkCrypto){

            $crypto = Crypto::find($checkCrypto->id);
            $crypto->symbol                 = $market[$i]['symbol'];
            $crypto->markPrice              = $market[$i]['markPrice'];
            $crypto->indexPrice             = $market[$i]['indexPrice'];
            $crypto->estimatedSettlePrice   = $market[$i]['estimatedSettlePrice'];
            $crypto->lastFundingRate        = $market[$i]['lastFundingRate'];
            $crypto->nextFundingTime        = $market[$i]['nextFundingTime'];
            $crypto->update();
          }else {

            $crypto                         = new  Crypto;
            $crypto->symbol                 = $market[$i]['symbol'];
            $crypto->markPrice              = $market[$i]['markPrice'];
            $crypto->indexPrice             = $market[$i]['indexPrice'];
            $crypto->estimatedSettlePrice   = $market[$i]['estimatedSettlePrice'];
            $crypto->lastFundingRate        = $market[$i]['lastFundingRate'];
            $crypto->nextFundingTime        = $market[$i]['nextFundingTime'];
            $crypto->save();
          }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
