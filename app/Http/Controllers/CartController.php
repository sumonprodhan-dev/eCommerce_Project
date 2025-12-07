<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //        return \Cart::clear();
        $cartItems = \Cart::getContent();
        return view('frontend.cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $product)
    {

        $product = Product::with('productImages')->findOrFail($product);
        // Get the first image
        $firstImage = $product->productImages->first();

        if ($product->discount_price <= 0)
            $price = $product->price;
        else
            $price = $product->discount_price;

        if (isset($request->quantity)) {
            if ($request->quantity >= 1) {
                \Cart::add($product->id, $product->name, $price, $request->quantity, array(
                    'image' => $firstImage,
                    'slug' => $product->slug,
                ));
            }
        } else {
            \Cart::add($product->id, $product->name, $price, 1, array(
                'image' => $firstImage,
                'slug' => $product->slug,
            ));
        }

        notyf()->success('Product Successfully added to your cart');
        return redirect()->back();
    }

    public function updateCart(Request $request, $cartId)
    {

        $quantity = $request->quantity;

        $product = Product::with('productImages')->findOrFail($cartId);
        // Get the first image
        $firstImage = $product->productImages->first();
        if ($product->discount_price <= 0) {

            $price = $product->price;
        } else {

            $price = $product->discount_price;
        }

        \Cart::remove($cartId);
        \Cart::add($product->id, $product->name, $price, $quantity, array(
            'image' => $firstImage,
            'slug' => $product->slug,
        ));
        notyf()->success('Cart product quantity updated seccessfully');
        return redirect()->back();
    }

    public function cartItemRemove($cartId)
    {
        \Cart::remove($cartId);

        notyf()->success('Product remove from your cart successfully ');
        return redirect()->back();
    }

    public function clearCart()
    {
        \Cart::clear();
        \Cart::clearCartConditions();
        notyf()->success('Cart Successfully cleared start new shopping ');
        return redirect()->back();
    }
}
