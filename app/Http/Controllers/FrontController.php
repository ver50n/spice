<?php

namespace App\Http\Controllers;

use App;
use Session;
use Lang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrontController extends Controller
{
  public function index(Request $request)
  {
    return view('front.landing');
  }
  
  public function products(Request $request)
  {
    $products = \App\Models\Product::with('productVariants')->get();

    $productsJson = $products->toJson();
    return view('front.products', [
      'products' => $products,
      'products_json' => json_encode($productsJson),
    ]);
  }

  public function about(Request $request)
  {
    return view('front.about');
  }

  public function contact(Request $request)
  {
    return view('front.contact');
  }
}