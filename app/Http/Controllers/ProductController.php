<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Validator;

class ProductController extends Controller
{
    public function index(){
        $product = Products::all();

        return response()->json([
            'success' => true,
            'message' => 'All Products',
            'data' =>$product
        ]);
    }

    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input,[
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'fail' => false,
                'message' => 'Sorry not stored',
                'error' =>$validator->errors()
                ]);
        }

        $product = Products::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Products created successfully',
            'product' =>$product
        ]);
    }

    public function show($id){
        $product = Products::find($id);

        if(is_null($product)){
            return response()->json([
                'fail' => false,
                'message' => 'Sorry not found',
                ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Products fetched successfully',
            'data' => $product
        ]);
    }

    public function update(Request $request, Products $product){
        $input = $request->all();

        $validator = Validator::make($input,[
            'name' => 'required',
            'detail' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'fail' => false,
                'message' => 'Sorry not stored',
                'error' =>$validator->errors()
                ]);
        }

        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Products has been updated successfully',
            'data' =>$product
        ]);
    }

    public function destroy(Products $product){

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Products has been updated successfully',
            'data' => $product
        ]);
    }
}
