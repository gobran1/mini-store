@extends('layouts.master')

<style>
    #sign {
        position: relative;
        bottom: 200px;
        background-color: rgba(255,255,255,.9);
        padding: 30px;
        color: #28b274;
    }
</style>

@section('pageHeader')
    <h1 class="text-center">Check Out</h1>
    <h4 class="text-center">total price : {{ $total }}</h4>

@endsection

@section('content')

    <div class="row"  id="sign">
        <div class="col-md-6 col-md-offset-3">

            <div class="alert alert-danger {{ !session()->has('error')?'hidden':'' }}" id="charge-error">
                {{ session()->get('error') }}
            </div>

            <form action="{{ route('checkout') }}" method="Post" id="checkout-form">
                <div class="form-group">
                    <label for="">Name :</label>
                    <input type="text" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Address :</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Card Holder Name :</label>
                    <input type="text" id="card-name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Credit Card Number :</label>
                    <input type="text" id="card-number" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <label for="">Expiration Month :</label>
                            <input type="text" id="card-expiry-month" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="">
                            <label for="" >Expiration Year :</label>
                            <input type="text" id="card-expiry-year" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">CVC :</label>
                    <input type="text" id="card-cvc" class="form-control" required>
                </div>
                {{ csrf_field() }}
                <input type="submit" id="submit-form" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection

