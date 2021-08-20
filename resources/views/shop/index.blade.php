@extends('layouts.master')

@section('title')
    laravel shopping cart
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('pageHeader')
    <div style="color: black;font-weight: bold;font-family: 'Book Antiqua';">
        <h2 class="text-center">First Shopping Place In The World</h2>
        <h3 class="text-center">Start Your Online Shopping</h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 alert alert-success">
            {{ session()->has('success')?session()->get('success'):'' }}
        </div>
    </div>
    <div class="sale-content">
        <div class="row" id="saleProducts">
        </div>
    </div>

    <div id="total-price">
        <h4></h4>
    </div>

    <div class="alert-danger" hidden id="error-block">
        there are an error , please wait a second
    </div>


    <script>
        var shopIndexUrl = '{{route('shop.index',[])}}';
        var addToCartUrl = '{{ route('products.add') }}';
        var token = '{{ csrf_token() }}';
    </script>

@endsection


@section('scripts')
    <script src="{{ asset('js/shop.js') }}"></script>
@endsection

