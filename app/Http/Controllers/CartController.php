<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function getExistingCart()
    {
        $user = auth()->user();

        return Cart::where('user_id', $user->id)->with('product')->get();
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
}
