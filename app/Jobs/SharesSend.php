<?php

namespace App\Jobs;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SharesSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $point;

    /**
     * Create a new job instance.
     */
    public function __construct($point)
    {
        $this->point = $point;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $clients = Client::where('points','>=', $this->point)->get();

        if ($clients->count() > 0) {
            foreach ($clients as $client) {
                if ($client->points >= $this->point) {
                    Log::alert($client->phone);
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
