<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\services\ShareService;
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
        $share = $this->shareService->send($id);
        return redirect()->route('shares.index')->with(['message' => $share->name . ' shares ta belgilengen '. $share->reqPoint.' - bali bar bolg`an klientlerge jiberildi!!!']);
    }


}
