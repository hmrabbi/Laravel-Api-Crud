<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function createProduct(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'qty_stock' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
           return response()->json([
            'status' => false,
            'message' => 'Product Not Inserted',
            'errors' => $validator->errors()
           ], 401);
        }

        $productall = $request->all();
        $products = Product::create($productall);

        return response()->json([
            'status' => 'true',
            'message' => 'Product Inserted Successfully',
            'data' => $products
        ]);
    }

    public function list(Request $request){
        $products = DB::table('products')->get();

        return response()->json([
            'status' => 'true',
            'message' => 'Data Save Successfully',
            'data' => $products
        ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'qty_stock' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
           return response()->json([
            'status' => false,
            'message' => 'Product Not Inserted',
            'errors' => $validator->errors()
           ], 401);  
       }

       $updateProduct = Product::find($id);
       if(!$updateProduct){
        return response()->jaon([
            'status' => 'false',
            'message' => 'data not found',
            'data' => $updateProduct
        ]);
       }

       $requestAll = $request->all();
       $products = $updateProduct->update($request->all());
        
       return response()->json([
        'status' => 'true',
        'message' => 'Product Update Successfully',
        'data' => $products
       ]);
   }

   public function productDelete(Request $request, $id){
    $productDelete = Product::find($id);
    if(!$productDelete){
        return response()->josn([
            'status' => 'false',
            'message' => 'Product Not Found',
            'data' => $productDelete
        ]);
    }
    $delete = $productDelete->delete();
    return response()->json([
        'status' => 'true',
        'message' => 'Product Delete Successfully!',
    ]);
   }
}
