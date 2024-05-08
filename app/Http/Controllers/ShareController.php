<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Share;
use App\services\ShareService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    protected $shareService;

    public function __construct(ShareService $shareService)
    {
        $this->shareService = $shareService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shares = $this->shareService->index();
        // return view('shares.index', ['shares' => $shares]);
        return view('shares.index', ['shares' => $shares]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shares.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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


        $date = Carbon::create($request->endDiscount)->setHour(23)->setMinute(59)->setSecond(59);

        if (!$date->gt(Carbon::now())) {
            return redirect()->back()->with(['message' => ' Akciya mu`ddetin Duris kiritin` o`tip ketken sa`neni kirittin`iz!!! ']);
        }

        $clientCount = Client::where('points','>=', $request->reqPoint)->count();
        if($request->has('send') && $clientCount == 0){
            return redirect()->back()->with(['message' => 'SMS jiberilmedi!!! klientlerdin` bali jetkilikli emes! ']);
        }

        $this->shareService->store($request);
        return redirect()->route('shares.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Share $share)
    {
        return view('shares.edit', ['share' => $share]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Share $share)
    {
        $date = Carbon::create($request->endDiscount)->setHour(23)->setMinute(59)->setSecond(59);

        if (!$date->gt(Carbon::now())) {
            return redirect()->back()->with(['message' => ' Akciya mu`ddetin Duris kiritin` o`tip ketken sa`neni kirittin`iz!!! ']);
        }
        $this->shareService->update($request, $share);
        return redirect()->route('shares.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Share $share)
    {
        $this->shareService->destroy($share);
        return redirect()->route('shares.index');
    }

    public function send($id)
    {
        $share = Share::find($id);

        $date = Carbon::create($share->endDiscount)->setHour(23)->setMinute(59)->setSecond(59);

        if (!$date->gt(Carbon::now())) {
            return redirect()->route('shares.index')->with(['message' => $share->name . ' tin` akciya mu`ddeti o`tip ketken. Sms jibere almaysiz!!!']);
        }

        $clientCount = Client::where('points','>=', $share->reqPoint)->count();
        if($clientCount == 0){
            return redirect()->back()->with(['message' => 'SMS jiberilmedi!!! klientlerdin` bali jetkilikli emes! ']);
        }

        $share = $this->shareService->send($id);

        return redirect()->route('shares.index')->with(['message' => $share->name . ' shares ta belgilengen '. $share->reqPoint.' - bali bar bolg`an '.$clientCount.' klientke SMS jiberildi!!!']);
    }


}
