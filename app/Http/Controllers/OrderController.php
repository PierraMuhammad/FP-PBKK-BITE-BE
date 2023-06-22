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
                'order_id' => $Order->id,
                'status' => $Order->status
            ]);
        }
        return false;
    }

    // public function createOrder(Request $request){
    //     // $request = $request->all();
    //     dd($request);
    //     /*
    //         perumpamaan data yang diterima:
    //         {
    //             'id' : 1,
    //             'user_id' : 1,
    //             'status' : "belum dibayar",
    //             'total' : 120000
    //             'product' : [
    //                 {'id' : 1, 'quantity': 1, 'total': 10000},
    //                 {'id' : 2, 'quantity': 1, 'total': 12000},
    //             ]
    //         }
    //     */

    //     $validateData = Validator::make($request->all(),[
    //         'user_id' => 'required',
    //         'status'=> 'required'
    //     ]);

    //     $total = 0;
    //     foreach($request["product"] as $product){
    //         $food = Food::where('id', product['id']);
    //         $total += $food['price'];
    //     }
    //     dd($total);
    // }

    public function updateOrder(Request $request){
        $request = $request->all();
        $order = Invoice::where('id', $request['id'])->update(['status' => "Sudah Selesai"]);
        if($order){
            return response()->json([
                "status" => "sudah berubah"
            ]);
        }
        return false;
    } 
}
