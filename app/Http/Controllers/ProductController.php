<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function create(){


        return view('products.create');
    }


    public function store(ProductRequest $request){


            $image = $request->file('image');

            $destinationPath = 'products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $request['image'] = "$profileImage";



           $admin = new Product();
           $admin->image = $profileImage;
           $admin->name = $request->name;
           $admin->price = $request->price;
           $admin->description = $request->description;
           $admin->save();


        if($admin){


            return response()->json([

                "status" => true,
                "message" => "product created successfully",

            ]);

        }else{

            return response()->json([

                "status" => false,
                "message" => "failed to create product please try again",

            ]);
        }


    }
}
