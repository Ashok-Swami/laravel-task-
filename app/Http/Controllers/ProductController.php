<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('index')->with('products', $product);
    }
    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $request->validate([

            "name" => 'required',
            'category' => 'required|not_in:-1',
            "description" => 'required',
            "price" => 'required',
            "quantity" => 'required',
            'images.*' => "mimes:jpg,png,jpeg|max:20000",

        ]);
        $input = $request->all();
        $product = Product::create($input);
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
        return redirect("/")->with('success', 'Product Successfully Created');
    }
    public function show($id)
    {
            $products = Product::with('image')
            ->where('products.id', $id)
            ->first();
        return view('view', compact('products'));
    }
    public function edit($id)
    {
        $products = Product::with('image')
            ->where('products.id', $id)
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
        return redirect("/")->with('success', 'Product Successfully Updated');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $images = Images::where("product_id", $product->id)->get();
        foreach ($images as $image) {
            if (File::exists("images/" . $image->image_name)) {
                File::delete("images/" . $image->image_name);
            }
        }
        $product->delete();
        return back()->with('success', 'Product Successfully Deleted');
    }
    public function deleteimage($id)
    {
        $images = Images::findOrFail($id);
        if (File::exists("images/" . $images->image_name)) {
            File::delete("images/" . $images->image_name);
        }
        Images::find($id)->delete();
        return back()->with('success', 'Image Successfully Deleted');
    }
}
