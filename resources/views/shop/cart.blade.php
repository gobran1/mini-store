@extends('layouts.master')

@section('title')
    cart details
@endsection


@section('pageHeader')
    <h1 class="text-center">Cart Details</h1>
    <div class="container">
        <table class="table-striped table-hover table table-responsive table-condensed">
            <thead >
                <th class="text-center">
                    Product Id
                </th>
                <th class="text-center">
                    Product Title
                </th>
                <th class="text-center">
                    Product Price
                </th>
                <th class="text-center">
                    Product Quantity
                </th>
                <th class="text-center">
                    Total Price
                </th>
                <th class="text-center">
                    Actions
                </th>
            </thead >
            <tbody class="text-center" >
                @if($cart != null)
                    @foreach($cart->items as $id=>$product)
                        <tr>
                            <td>
                                {{ $id }}
                            </td>
                            <td>
                                {{ $product['item']->title }}
                            </td>
                            <td>
                                {{ $product['item']->price }}
                            </td>
                            <td>
                                {{ $product['qty'] }}
                            </td>
                            <td>
                                {{ $product['price'] }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <a href="" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('removeOne',[$id]) }}">Remove Item</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('removeItem',[$id]) }}">Remove All</a></li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <h3>Total Price : {{ session('cart')->totalPrice }}</h3>

        <a href="{{ route('checkout') }}"
           class="btn btn-success  " style="margin-top: 80px">Check Out</a>

    </div>
@endsection