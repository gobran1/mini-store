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

@section('content')


    <div id="sign">

        <h1 class="text-center" style="font-family:'Century Schoolbook';color: black;margin-bottom: 40px;">Log In</h1>
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ul>

                        @foreach($errors->all() as $error)
                              <li class="alert-danger list-unstyled text-center">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="{{ route('user.login') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="">Email : </label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group  {{ $errors->has('password')?'has-error':'' }}  ">
                        <label for="">Password : </label>
                        <input type="password" name="password" class="form-control"  required>
                    </div>
                    <div class="clearfix">
                        <input type="submit" value="Log In" class="btn btn-primary pull-right" style="margin-top: 30px">
                    </div>
                </form>
                <p>if you not have an account <strong><a href="{{ route('user.showRegisterForm') }}">sign up</a></strong> now</p>

            </div>
        </div>
    </div>

@endsection
