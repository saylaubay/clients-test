<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ShareController;
use App\Models\Client;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome', ['sharesCount'=>Share::all()->count(), 'clientCount'=>Client::all()->count()]);
})->name('home');

Route::post('saat', function(Request $request){
})->name('saat');

Route::get('/send/{id}', [ShareController::class, 'send'])->name('shares.send');

Route::resources([
    'clients'=> ClientController::class,
    'shares'=> ShareController::class,
    'rules'=> RuleController::class,
]);
