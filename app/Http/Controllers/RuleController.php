<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\services\RuleService;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    protected $ruleService;

    public function __construct(RuleService $ruleService)
    {
        $this->ruleService = $ruleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->ruleService->index();
        return view('rule.index', ['rule' => $data['rule'], 'saat'=>$data['saat']]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rule $rule)
    {
        return view('rule.edit', ['rule' => $rule]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rule $rule)
    {
        $data = $this->ruleService->update($request, $rule);
        return redirect()->route('rules.index', ['saat'=>$data['saat']])->with(['message'=>'Sms jiberiw waqti '. $data['hour'].':'.$data['minute'].' qa o`zgerdi!!!']);
    }

}
