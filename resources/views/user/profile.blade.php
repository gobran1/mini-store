@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('pageHeader')
    <h2 class="text-center">Your Orders</h2>
    <hr>
@endsection

@section('content')
    <div class="sale-content">
        <div class="row" id="saleProducts">

            @if(sizeof($orders) >  0)
                <div class="panel-group">
                    @foreach($orders as $order)
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-info panel">
                                    <div class="panel-heading">
                                        <a href="#panel{{ $order->id }}" data-toggle="collapse">
                                            <div class="panel-title">
                                                Order  <strong>{{ $order->id }}</strong>
                                                <span class="pull-right caret"></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="collapse panel-collapse" id="panel{{ $order->id }}">
                                        <div class="panel-body ">

                                            @foreach($order->cart->items as $product)

                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        {{ $product['item']->title }} | {{ $product['qty']  }} amount
                                                        <span class="badge">{{ $product['price'] }}</span>
                                                    </li>
                                                </ul>

                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        Total Price :  <strong>{{ $order->cart->totalPrice }} </strong>$
                                    </div>

                                </div>
                                <br>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert-info alert text-center"><strong class="text-warning">No Orders Yet</strong></div>

            @endif


        </div>
</div>
@endsection