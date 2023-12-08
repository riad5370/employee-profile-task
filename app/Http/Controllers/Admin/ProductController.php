<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product.index',[
            'products'=>Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'details'=>'required|string',
            'price'=>'required|numeric',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'array',
            'image.*'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // Handle thumbnail image
        if ($request->file('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = Str::random(3).rand(100,999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/thumbnail/'), $imageName);
        }

        // Create Product
        $product = Product::create([
            'name'=>$request->name,
            'details'=>$request->details,
            'price'=>$request->price,
            'thumbnail_image'=>$imageName,
        ]);

        // Handle additional images
        foreach($request->file('image') as $image){
            $imageName = Str::random(3).rand(100,999).$product->id.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/image/'), $imageName);

            ProductImage::create([
                'product_id'=>$product->id,
                'image'=>$imageName
            ]);

        }
        return back()->withSuccess('product has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.view',[
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // $product = Product::find($product);
        return view('product.edit',[
            'product'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'thumbnail_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Update Product
        $product->update([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $request->price,
        ]);

        // Handle updated thumbnail image
        if ($request->file('thumbnail_image')) {
            // Delete old thumbnail if it exists
            if ($product->thumbnail_image) {
                $thumbnailPath = public_path('uploads/thumbnail/' . $product->thumbnail_image);
                if(file_exists($thumbnailPath)){
                    unlink($thumbnailPath);
                }
            }
            // Upload new thumbnail
            $image = $request->file('thumbnail_image');
            $imageName = Str::random(3).rand(100,999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/thumbnail/'), $imageName);
            $product->update(['thumbnail_image' => $imageName]);
        }

        // Handle updated additional images
        if($request->file('image')){
            foreach ($request->file('image') as $image) {

                 // Delete old additional image if it exists
                $oldImage = ProductImage::where('product_id', $product->id)->first();
                if($oldImage){
                    $imagePath = public_path('uploads/image/' . $oldImage->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    $oldImage->delete();
                }
                // Upload new additional image
                $imageName = Str::random(3).rand(100,999).$product->id.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/uploads/image/'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageName
                ]);
            }
        }
        return Redirect::route('products.index')->withSuccess('product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->thumbnail_image){

            $thumbnailPath = public_path('uploads/thumbnail/' . $product->thumbnail_image);
            if(file_exists($thumbnailPath)){
                unlink($thumbnailPath);
            }
        }
        $images = ProductImage::where('product_id', $product->id)->get();
        
            foreach ($images as $image) {
                $imagePath = public_path('uploads/image/' . $image->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

               // Delete the database record
                $image->delete();
            }
        
        $product->delete();
        return back()->withSuccess('product has been deleted!');
    }
}
