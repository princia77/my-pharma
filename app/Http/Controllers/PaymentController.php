<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function processPayment()
    {
        try{
            $authUser = (new User)->find(Auth::id());
            $existingOpenOrder = $authUser->orders()->whereNull('payment_id')->first();

            $payment = new Payment();
            $payment->amount = $existingOpenOrder->total;
            $payment->status = 'completed';
            $payment->save();

            $existingOpenOrder->payment_id = $payment->id;
            $existingOpenOrder->save();
        }catch (Exception $e){
            return redirect()->back()->withErrors([
                'error' => 'oops, there was an error'
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
