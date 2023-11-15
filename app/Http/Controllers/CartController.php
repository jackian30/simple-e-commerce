<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreCartRequest $request)
    {
        $user = auth()->user();

        if (sizeof($request->products) > 0) {
            $saved = [];

            foreach ($request->products as $key => $product) {
                $res = Cart::updateOrCreate(
                    [
                        'product_id' => $product['id'],
                        'user_id' => $user->id,
                    ],
                    [
                        'quantity' => $product['quantity'],
                    ]
                );

                array_push($saved, $res->id);
            }

            Cart::whereNotIn('id', $saved)->where('user_id', $user->id)->delete();

            return Cart::where('user_id', $user->id)->with('product')->get();
        } else {
            Cart::where('user_id', $user->id)->delete();
        }
    }

    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    public function destroy(Cart $cart)
    {
        //
    }
}
