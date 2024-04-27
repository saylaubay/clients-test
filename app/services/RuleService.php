<?php


namespace App\services;


use App\Models\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RuleService
{

    public function index()
    {
        $rule = Rule::find(1);
        $hour = strlen($rule->sendHour) == 1 ? '0'.$rule->sendHour : $rule->sendHour;
        $minute = strlen($rule->sendMinute) == 1 ? '0'.$rule->sendMinute : $rule->sendMinute;
        $saat = $hour.':'.$minute;
        return ['rule'=>$rule, 'saat'=>$saat];
    }

    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'saat' => 'required',
        ]);
        $time = Carbon::create()->setHour(intval(substr($request->saat,0,2)))->setMinute(intval(substr($request->saat,3,2)))->setSecond(0);

        $hour = strlen($time->hour) == 1 ? '0'.$time->hour : $time->hour;
        $minute = strlen($time->minute) == 1 ? '0'.$time->minute : $time->minute;

        $saat = $hour.':'.$minute;

        $rule->sendHour = $time->hour;
        $rule->sendMinute = $time->minute;
        $rule->update();
        return ['saat'=>$saat, 'hour'=>$hour, 'minute'=>$minute];
    }

}
