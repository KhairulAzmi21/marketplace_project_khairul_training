<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch all products that belongs to authenticate user
        $products = Product::where('user_id', auth()->user()->id)->latest()->get();
        // $product = auth()->user()->products;

        return view("products.index", [ 'products' => $products ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        //
        $path = $request->file('image')->store('public/products');

        Product::create([
            'user_id' => auth()->user()->id,
            'title'   => $request->title,
            'body'   => $request->body,
            'price'   => $request->price,
            'category'   => $request->category,
            'image_path' => $path,
        ]);
        // session flash
        return redirect('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $post = Product::find($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //some validation

        // if user add a new image , update the image
        if($request->image != null){
            $path = $request->file('image')->store('public/products');
        }
        $product->update([
            'title'   => $request->title,
            'body'   => $request->body,
            'price'   =>  auth()->user()->id == $product->user_id ? $request->price : $product->price ,
            'category'   => $request->category,
            'image_path' => $request->image != null ? $path : $product->image_path,
            'status' => $request->status,
        ]);
        // session for flash message
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        //flash message say delete successful
        return redirect('/products');

    }

    public function search()
    {
        $products = Product::query();

        if(request()->has('search')){
            $products = $products->where('title', 'LIKE', '%'.request()->search.'%')
                            ->orWhere('status', 'LIKE', '%'.request()->search.'%')
                            ->orWhere('category', 'LIKE', '%'.request()->search.'%');
        }

        $products = $products->latest()->paginate(4);

        // send to view welcome
        return view('welcome', [ 'products' => $products ]);
        // return view('searchResult', [ 'products' => $products ]);
    }
}
