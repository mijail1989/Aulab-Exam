<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {

        $products = Product::where("is_accepted", true)->orderByDesc('created_at')->paginate(12);
        return view("/products/index", compact("products"));
    }

    public function userProdotti()
    {
        $productsUser = [];
        if (Auth::user()->products) {
            $productsUser = Product::where("user_id", '=', Auth::user()->id)->orderByDesc('created_at')->paginate(8);
        }
        return view("auth/prodotti-utente", compact("productsUser"));
    }

    public function userProdDettaglio($id)
    {
        $userProduct = Product::find($id);
        return view('auth.prodotto-dettaglio', compact('userProduct'));
    }

    public function create()
    {
        return view("/products/create");
    }

    public function show(Product $product, Category $category)
    {
        $productsCategory = Product::where('is_accepted', true)->where("id", '!=', $product->id)->where("category_id", '=', $product->category_id)
            ->get();
        return view('products/show', compact('product', "productsCategory"));
    }
}
