<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Checkout;
use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Requests\UpdateCheckoutRequest;
use App\Models\Cart;
use App\Models\CheckoutProduct;

class CheckoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Checkout/Index');
    }

    public function create()
    {
        //
    }

    public function store(StoreCheckoutRequest $request)
    {
        //
    }

    public function checkoutCart(StoreCheckoutRequest $request)
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

        return true;
    }
}
