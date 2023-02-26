<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'order_value', 'order_status','process_id'];

           public function saveOrder(Request $request)
    { 

			date_default_timezone_set('Asia/Colombo');
			$order_date=date('Y-m-d h:i:s');   
			$data=$request->all();
			$process_id=rand(1,10);
			$order_status='Processing';

            $order_id = DB::table('order_details')->insertGetId(
            ['customer_name' => $data['name'], 'order_value' => $data['order_value'], 'order_status' => $order_status, 'process_id' => $process_id, 'order_date' => $order_date]
            );

           if($order_id>0){
            return array('Order_ID' =>$order_id,'Customer_Name' =>$data['name'],'Order_Value' =>$data['order_value'],'Order_Date' =>$order_date,'Order_Status' =>$order_status,'Process_ID' =>$process_id);
           }else{
           	return array();
           }


     }       
}