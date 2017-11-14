<?php

namespace Selfreliance\Balance;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\Payment_System;
use App\Models\Currency_Rate;

class BalanceController extends Controller
{
    /**
     * Index
     * @return view home with feedback messages
    */    
    public function index()
    {
    	$payment_system = Payment_System::orderBy('sort', 'asc')->get();
    	// dd($payment_system);
        return view('balance::index')->with([
        	"payment_system" => $payment_system
        ]);
    }

    public function loadbalance($id){
        try{
            $payment = Payment_System::where('id', $id)->firstOrFail();
            
            $temp = $payment->class_name;
            if (!class_exists($temp)) {
                throw new \Exception('Empty payment module');
            }  

            $class = new $temp();
            if(!method_exists($class,'balance')){
                throw new \Exception('Not found payment module');
            }

            if(isset($class)){
                try {
                    $Currency_Rate = Currency_Rate::orderBy('id', 'desc')->first();
                    $res = $class->balance($payment->currency);
                    $responce = $res." ".$payment->currency;
                    if($payment->currency == "BTC"){
                        $responce .= " ~ ".$res*$Currency_Rate->btc_usd." USD";
                    }
                    if($payment->currency == "ETH"){
                        $responce .= " ~ ".$res*$Currency_Rate->eth_usd." USD";
                    }
                    if($payment->currency == "DASH"){
                        $responce .= " ~ ".$res*$Currency_Rate->dsh_usd." USD";
                    }
                    if($payment->currency == "LTC"){
                        $responce .= " ~ ".$res*$Currency_Rate->ltc_usd." USD";
                    }
                    echo $responce;
                }catch(\Exception $e){
                    dd($e);
                }
            }            
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
}