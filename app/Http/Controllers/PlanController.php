<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::get();
        return view('plan.index', ['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request data
        $validatedData = $request->validate([
            'plan' => 'required|numeric',
            'token' => 'required|string'
        ]);
        // find plan by ID from the database
        $plan = Plan::find($validatedData['plan']);
        
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);
        return view('plan.success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan, Request $request)
    {
         $intent = auth()->user()->createSetupintent(); 
        return view('plan.show', ['plan' => $plan, 'intent'=> $intent]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
