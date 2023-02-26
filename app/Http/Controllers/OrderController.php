<?php

namespace App\Http\Controllers;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $api_order;
    

    public function __construct(OrderDetails $api_order)
    {
        $this->api_order = $api_order;
    }

        public function saveOrder(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'order_value' => 'required|numeric',
        ]);
          //print_r($data); 

        $data_result=$this->api_order->saveOrder($request);
  
        if(!empty($data_result)){
            return response()->json(['result' => $data_result]);
        }else{
            return response()->json(['result' => false]);
        }


        //$check = $this->create($data);
         
        //return redirect("dashboard")->withSuccess('You have signed-in');
    }
}
