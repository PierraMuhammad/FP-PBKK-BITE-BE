<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Food;
use App\Models\User;
use Validator;

class OrderController extends Controller
{
    public function createOrder(Request $request){
        $validateData = Validator::make($request->all(),[
            'product_id' => 'required',
            'quantity'=> 'required',
            'total' => 'required',
            'status' => 'required'
        ]);

        $product = Food::where('id', $request['product_id'])->get();
        $product = $product->all();
        $product = $product[0];

        if($request['total'] != $product['price'] * $request['quantity']){
            $request['total'] = $product['price'] * $request['quantity'];
        }

        $input = $request->all();
        $Order = Invoice::create($input);
        if($Order){
            return response()->json([
                'success' => false,
                'order_id' => $Order->id,
                'status' => $Order->status
            ]);
        }
        return response()->json([
            'success' => false,
            'status' => 400
        ]);
    }


    public function updateOrder(Request $request){
        $request = $request->all();
        $order = Invoice::where('id', $request['id'])->update(['status' => "Sudah Selesai"]);
        if($order){
            return response()->json([
                "status" => "sudah berubah",
                "code" => 201
            ]);
        }
        return false;
    } 
}
