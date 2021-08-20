<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Error;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //



    public function showRegisterForm()
    {
        return view('user.sign-up');
    }

    public function showLoginForm()
    {
        return view('user.sign-in');
    }

    public function signUp(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:80',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        Auth::login($user);

        if(session()->has('oldUrl')){
            $oldUrl = session()->get('oldUrl');
            session()->forget('oldUrl');
            return redirect()->to($oldUrl);
        }

        return redirect()->route('user.profile');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->email , 'password' => $request->password], false)) {
            if(session()->has('oldUrl')){
                $oldUrl = session()->get('oldUrl');
                session()->forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
        }
        return redirect()->back()->withErrors(['password' => 'password is not correct'])->withInput();
    }

    public function logout(Request $request){
        $request->flush();
        Auth::logout();
        return redirect()->route('main.show');
    }

    public function profile()
    {
//        $orders = Auth::user()->orders;
//
//        $mainCart = new Cart(null);
//
//        foreach ($orders as $order){
//            $cart = unserialize($order->cart);
//
//            foreach($cart->items as $key=>$product){
//                $mainCart->addItem($key,$product);
//            }
//            $mainCart->totalQty+= $cart->totalQty;
//            $mainCart->totalPrice+= $cart->totalPrice;
//
//        }

        $orders = Auth::user()->orders;
        $orders->transform(function ($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });


        return view('user.profile',['orders' => $orders]);
    }

}