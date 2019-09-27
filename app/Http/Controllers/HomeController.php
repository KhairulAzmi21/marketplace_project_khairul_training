<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // fetch all products
        $products = Product::query();

        // check whether request has category or not
        if(request()->has('category')){
            // if request category exists , append where method
            $products = $products->where('category', request()->category);
        }

        $products = $products->where('is_active',true)->latest()->paginate(8);

        // send to view welcome
        return view('welcome', [ 'products' => $products ]);
    }
}
