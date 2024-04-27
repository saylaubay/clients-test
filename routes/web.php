<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ShareController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', function () {
//    \Illuminate\Support\Facades\Redis::setName('at');





//    $name = \Illuminate\Support\Facades\Redis::get('at');
    return view('welcome');
});

Route::get('test', function (){
//    $clients = Client::where('points','>=', 30)->get();
//    dd($clients);

//    $share = Share::find(1);
    // $start = Carbon::create(2024,04,28);
//    if (!$start->gt(Carbon::now())) {
//        dd("QATE");
//        return redirect()->back()->with(['message' => 'Date qa`te kiritildi!!!']);
//    }

//    $time = Carbon::create($start);

//    dd(Carbon::now()->day);
    // return view('test');

    // $time = Carbon::now()->setHour('22');
    // dd($time->hour);

    $start = Carbon::now()->setHour(14)->setMinute(20)->setSecond(4);
    $end = Carbon::now()->setHour(14)->setMinute(20)->setSecond(3);

    // dd($start->diffInSeconds($end));
    if($start->diffInSeconds($end)){
        dd("ULEKN");
    }else{
        dd("KISHI");
    }


});

Route::post('saat', function(Request $request){
    dd($request);
})->name('saat');

Route::get('/send/{id}', [ShareController::class, 'send'])->name('shares.send');

Route::resources([
    'clients'=> ClientController::class,
    'shares'=> ShareController::class,
    'rules'=> RuleController::class,
]);
