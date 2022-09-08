<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Models\Crypto;
use App\Models\Cryptoorder;
use Scngnr\Mdent\Binance\BinanceClient;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/index',  App\Http\Livewire\Index::class);

Route::get('schedule/run', function(){

  Artisan::call("schedule:run");
});

Route::get('/market', function () {

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
});

Route::get('/market/{action}/{coin}', function ($action, $coin) {

  $openOrdersCheck = Cryptoorder::where('symbol', $coin . 'USDT')
                                ->where('clientOrderId', NULL)
                                ->first();

  if($action == "buy"){ //all bilgisi geldi

    if($openOrdersCheck){ //açık işlemi var mı

      if($openOrdersCheck->status == "sell"){ //açık işlem short ise

        $coinPrice = Crypto::where('symbol', $coin . 'USDT')->first();

        if($coinPrice){

          $orders = Cryptoorder::find($openOrdersCheck->id);

          $dizi['alis'] = $orders->price ; $dizi['satis'] = $coinPrice->markPrice ;

          $orders->symbol         =  $coin . 'USDT';
          $orders->avgPrice       =  $coinPrice->markPrice;
          $orders->clientOrderId  =  "closed";
          $orders->origQty        =  max($dizi) / min($dizi);
          $orders->update();
        }
      }
    }else {

      $coinPrice = Crypto::where('symbol', $coin . 'USDT')->first();
      if($coinPrice){

        $orders = new Cryptoorder;
        $orders->symbol   =  $coin . 'USDT';
        $orders->status   =  $action;
        $orders->price    =  $coinPrice->markPrice;
        $orders->save();
      }
    }
  }else   if($action == "sell"){ //all bilgisi geldi

      if($openOrdersCheck){ //açık işlemi var mı

        if($openOrdersCheck->status == "buy"){ //açık işlem short ise

          $coinPrice = Crypto::where('symbol', $coin . 'USDT')->first();

          if($coinPrice){

            $orders = Cryptoorder::find($openOrdersCheck->id);

            $dizi['alis'] = $orders->price ; $dizi['satis'] = $coinPrice->markPrice ;

            $orders->symbol         =  $coin . 'USDT';
            $orders->avgPrice       =  $coinPrice->markPrice;
            $orders->clientOrderId  =  "closed";
            $orders->origQty        =  max($dizi) / min($dizi);
            $orders->update();
          }
        }
      }else {

        $coinPrice = Crypto::where('symbol', $coin . 'USDT')->first();
        if($coinPrice){

          $orders = new Cryptoorder;
          $orders->symbol   =  $coin . 'USDT';
          $orders->status   =  $action;
          $orders->price    =  $coinPrice->markPrice;
          $orders->save();
        }
      }
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
