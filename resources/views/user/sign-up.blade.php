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
        <h1 class="text-center" style="font-family: 'Century Schoolbook';color: black;margin-bottom: 40px;">Sign Up</h1>
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ul>
                        @foreach($errors->all() as $error )
                            <li class="list-unstyled text-center alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="{{ route('user.signUp') }}" method="post" id="register-form">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('name')?'has-error':'' }} ">
                        <label for="">Name : </label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name')}}" required>
                    </div>

                    <div class="form-group {{$errors->has('email')?'has-error':''}}">
                        <label for="">Email : </label>
                        <input type="email" name="email" placeholder="Enter Email" value="{{old('email')}}" class=" form-control" required>
                    </div>

                    <div class="form-group {{$errors->has('password')?'has-error':''}}">
                        <label for="">Password : </label>
                        <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password : </label>
                        <input class="form-control" type="password" name="confirmedPassword" required >
                    </div>

                    <input type="submit" id="submit" class="btn btn-primary pull-right" value="Register" style="margin-top: 30px">

                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/signUp.js') }}"></script>
@endsection
