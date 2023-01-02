<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;

class CustomerController extends Controller
{
    public function createCustomer(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' => 'required', 
            'last_name' => 'required', 
            'phone_number' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'city' => 'required' 
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ], 401);
        }

        $customerAll = $request->all();
        $customer = Customer::create($customerAll);
        return response()->json([
            'status' => true,
            'message' => 'Data Save Successfully!',
            'data' => $customer
        ]);
    }

    public function createList(Request $request){
        $list = DB::table('customers')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Save Successfully!',
            'data' => $list
        ]);
    }

    public function customerUpdate(Request $request,$id){
         $validator = Validator::make($request->all(),[
            'first_name' => 'required', 
            'last_name' => 'required', 
            'phone_number' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'city' => 'required' 
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ], 401);
        }

        $customer = Customer::find($id);
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $customer
            ]);
        }
        $customerAll = $request->all();
        $update = $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data Update Successfully',
            'data' => $update
        ]);
    }
}
