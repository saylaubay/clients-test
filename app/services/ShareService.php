<?php


namespace App\services;


use App\Jobs\SharesSend;
use App\Models\Share;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShareService
{

    public function index()
    {
        return Share::all();
    }

    public function store(Request $request)
    {
        $startDate = Carbon::create(
            substr($request->startDiscount, 0, 4),
            substr($request->startDiscount, 5, 2),
            substr($request->startDiscount, 8, 2)
        )->setHour(0)->setMinute(0)->setSecond(1);

        $endDate = Carbon::create(
            substr($request->endDiscount, 0, 4),
            substr($request->endDiscount, 5, 2),
            substr($request->endDiscount, 8, 2)
        )->setHour(23)->setMinute(59)->setSecond(59);

        if (!$endDate->gt($startDate)) {
            return redirect()->back()->with(['message' => 'Date qa`te kiritildi!!!']);
        }

        $savedShare = Share::create([
            'name' => $request->name,
            'startDiscount' => Carbon::create(
                substr($request->startDiscount, 0, 4),
                substr($request->startDiscount, 5, 2),
                substr($request->startDiscount, 8, 2)
            ),
            'endDiscount' => Carbon::create(
                substr($request->endDiscount, 0, 4),
                substr($request->endDiscount, 5, 2),
                substr($request->endDiscount, 8, 2)
            ),
            'percent' => $request->percent,
            'reqPoint' => $request->reqPoint,
        ]);

        if ($request->has('send')) {
            dispatch(new SharesSend($savedShare->reqPoint));
            $savedShare->sended = 'YES';
            $savedShare->update();
            return redirect()->route('shares.index')->with(['message' => $savedShare->name . ' shares ta belgilengen '. $savedShare->reqPoint.' - bali bar bolg`an klientlerge jiberildi!!!']);
        }
    }

    public function update(Request $request, Share $share)
    {
        $request->validate([
            'name' => 'required',
            'startDiscount' => 'required',
            'endDiscount' => 'required',
            'percent' => 'required',
            'reqPoint' => 'required',
        ]);

        $share->name = $request->name;
        $share->startDiscount = Carbon::create(
            substr($request->startDiscount, 0, 4),
            substr($request->startDiscount, 5, 2),
            substr($request->startDiscount, 8, 2)
        );
        $share->endDiscount = Carbon::create(
            substr($request->endDiscount, 0, 4),
            substr($request->endDiscount, 5, 2),
            substr($request->endDiscount, 8, 2)
        );
        $share->percent = $request->percent;
        $share->reqPoint = $request->reqPoint;
        $share->update();
    }

    public function destroy(Share $share)
    {
        $share->delete();
    }

    public function send($id)
    {
        $share = Share::find($id);
        dispatch(new SharesSend($share->reqPoint));
        $share->sended = 'YES';
        $share->save();
        return $share;
    }

}
