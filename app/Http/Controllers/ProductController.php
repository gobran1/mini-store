<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    //

    public function index($page)
    {
        $products = Product::get()->slice(8 * $page)->take(8);
        return response()->json($products);
    }


    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->productId);

        $oldCart = null;
        if (session()->has('cart')) {
            $oldCart = session('cart');
        }

        $cart = new Cart($oldCart);


        $cart->add($product);

        session()->put(['cart' => $cart]);


        $qty = $cart->items[$product->id]['qty'];
        $totalPrice = $cart->totalPrice;
        return response(['qty' => $qty, 'totalPrice' => $totalPrice]);

    }

    public function removeItemByOne($id){

        $cart = new Cart(session()->get('cart'));

        $cart->reduceByOne($id);

        if($cart->totalQty > 0){
            session()->put('cart',$cart);
        }
        else{
            session()->forget('cart');
        }
        return back();

    }

    public function removeItem($id){
        $cart = new Cart(session()->get('cart'));

        $cart->reduceItem($id);

        if($cart->totalQty > 0){
            session()->put('cart',$cart);
        }
        else{
            session()->forget('cart');
        }
        return back();
    }



    public function showCart()
    {
        if (session()->has('cart'))
            return view('shop.cart', ['cart' => session('cart')]);
        return redirect()->route('main.show');
    }

    public function showCheckoutForm()
    {
        if (!session()->has('cart'))
            return redirect()->route('main.show');
        $total = session('cart')->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function checkout(Request $request)
    {
        if (!session()->has('cart'))
            return redirect()->route('main.show');

        $cart = new Cart(session()->get('cart'));

        Stripe::setApiKey('sk_test_9J9zB5ekN2Pc29haSleZoR1400B88zyOjs');

        try {
            $charge = Charge::create(array(
                'amount' => $cart->totalPrice,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'sell',
            ));

            $order = new Order([
                'payment_id' => $charge->id,
                'cart' => serialize($cart),
                'address'=> $request->address,
            ]);

            Auth::user()->orders()->save($order);

        } catch (\Exception $e) {
           return redirect()->route('checkout')->with('error', $e->getMessage());
        };

        session()->forget('cart');
        return redirect()->route('main.show')->with('success', 'buy successful goto to your profile and discover your purchase');
    }

}