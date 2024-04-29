<?php

namespace App\Jobs;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $list = Client::all();
        foreach ($list as $client){
            $date = Carbon::create($client->birthDate);
            if ($date->month == Carbon::now()->month && $date->day == Carbon::now()->day){
                Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->getToken(),
                ])->post('notify.eskiz.uz/api/message/sms/send', [
                    'mobile_phone' => $client->phone,
                    'message' => 'Это тест от Eskiz',
                    'from' => '4546',
                ]);
            }
        }
    }

    public function getToken()
    {
        $token = Cache::get('sms_token');
        if (!$token){
            $res = Http::post('notify.eskiz.uz/api/auth/login',[
                'email'=>'saylaww@gmail.com',
                'password'=>'lBAZRqNfFacr68GDFrxFcWps3wqQfDnuoNlL2Zff',
            ]);
            $token = $res['data']['token'];
            Cache::put('sms_token', $token, now()->addDays(30));
        }
        return $token;
    }


}
