<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\CheckoutProduct;
use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Requests\UpdateCheckoutRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Checkout/Index');
    }

    public function single(Product $product)
    {
        return Inertia::render('Checkout/SingleCheckout', ['product' => $product]);
    }

    public function singleCheckout(Product $product, Request $request)
    {
        $user = auth()->user();

        $totalPrice = $product->price * $request->quantity;

        $checkout = Checkout::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);

        CheckoutProduct::updateOrCreate(
            [
                'checkout_id'   => $checkout->id,
                'product_id' => $product->id
            ],
            [
                'price' => $totalPrice,
                'original_price'  => $product->price,
                'quantity' =>  $request->quantity,
            ]
        );

        return true;
    }

    public function create()
    {
        //
    }

    public function store(StoreCheckoutRequest $request)
    {
        //
    }

    public function checkoutCart(Request $request)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->with('product')->get();

        $totalPrice = 0;

        foreach ($cart as $key => $product) {
            $totalPrice += $product->quantity * $product->product->price;
        }

        $checkout = Checkout::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);

        foreach ($cart as $key => $product) {
            CheckoutProduct::updateOrCreate(
                [
                    'checkout_id'   => $checkout->id,
                    'product_id' => $product->product->id
                ],
                [
                    'price' => $product->quantity * $product->product->price,
                    'original_price'  => $product->product->price,
                    'quantity' =>  $product->quantity,
                ]
            );
        }

        Cart::where('user_id', $user->id)->delete();

        return true;
    }
}
