<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Product::join('images', 'images.product_id', '=', 'products.id')
        // ->get(['*']);
              		// dd($data);
        $product = Product::all();
        return view('index')->with('products', $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product([
            "name" => $request->name,
            "category" => $request->category,
            "description" => $request->description,
            "price" => $request->price,
            "quantity" => $request->quantity,
        ]);
        $product->save();
        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();

                $request['product_id'] = $product->id;
                $request['image_name'] = $imageName;
                $file->move(\public_path("/images"), $imageName);
                Images::create($request->all());
            }
        }
        return redirect("/")->with('success', 'Product Successfully Created');;
    }
    public function show($id)
    {
        $products = Product::join('images', 'products.id', '=', 'images.product_id')
                ->where('products.id', $id)
                ->select(['products.*', 'images.id as img_id','images.image_name','images.product_id'])
                ->first();
        return view('view', compact('products'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $products = Product::join('images', 'products.id', '=', 'images.product_id')
                ->where('products.id', $id)
                ->select(['products.*', 'images.id as img_id','images.image_name','images.product_id'])
                ->first();
        return view('edit', compact('products'));       
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            "name" => $request->name,
            "category" => $request->category,
            "description" => $request->description,
            "price" => $request->price,
            "quantity" => $request->quantity,
        ]);

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['product_id'] = $product->id;
                $request['image_name'] = $imageName;
                $file->move(\public_path("images"), $imageName);
                Images::create($request->all());
            }
        }

        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $images = Images::where("product_id", $product->id)->get();
        // dd($images);
        foreach ($images as $image) {
            if (File::exists("images/" . $image->image_name)) {
                File::delete("images/" . $image->image_name);
            }
        }
        $product->delete();
        return back();
    }

    public function deleteimage($id)
    {
        $images = Images::findOrFail($id);
        if (File::exists("images/" . $images->image_name)) {
            File::delete("images/" . $images->image_name);
        }

        Images::find($id)->delete();
        return back();
    }
}
