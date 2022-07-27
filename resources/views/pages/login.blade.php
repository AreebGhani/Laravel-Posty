@extends('app')
@section('content')

<nav class="bg-white p-2 m-3">
    <div class="row">
        <div class="col-3 text-left">
            <a href="{{ url('home') }}" class="p-3">Home</a>
            <a href="{{ url('dashboard') }}" class="p-3">Dashboard</a>
        </div>
        <div class="col-6"></div>
        <div class="col-3 text-right">
            @auth
            <a href="{{route('user', auth()->user()->id)}}" class="p-3 text-capitalize">{{auth()->user()->name}}</a>
            <a href="" id='logout_confirm' class="p-3">Logout</a>
            @endauth
            @guest
            <a href="{{ url('login') }}" class="p-3 font-weight-bold"><span class="pl-1 pr-1">Login</span></a>
            <a href="{{ url('register') }}" class="p-3">Register</a>
            @endguest
        </div>
    </div>
</nav>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12"></div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-3 md-3">
        <form class="bg-white p-3" action="{{ route('login') }}" method="post">
            {!! csrf_field() !!}
            @if(session('error'))
            <div class="text-center alert-danger"><span class="text-danger">{{ session('error') }}</span></div><br>
            @endif
            @if(session('success'))
            <div class="text-center alert-success"><span class="text-success">{{ session('success') }}</span></div><br>
            @endif
            <label>Email</label></br>
            @error('email')
            <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <input type="text" value="@if(session('useremail')){{session('useremail')}}@else{{old('email')}}@endif" placeholder="Enter your email" name="email" id="email" class="form-control" @error('email') style="border: 1px red solid;" autofocus @enderror><br>
            <label>Password</label></br>
            @error('password')
            <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <input type="password" value="@if(session('userpassword')){{session('userpassword')}}@else{{old('password')}}@endif" placeholder="Enter your password" name="password" id="password" class="form-control" @error('password') style="border: 1px red solid;" autofocus @enderror><br>
            <div class="form-check mb-1">
                <input type="checkbox" style="cursor: pointer;" checked class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="cursor: pointer;">Remember Me</label>
            </div>
            <button type="submit" class="mt-1 btn btn-primary">Login</button></br>
        </form>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12"></div>
</div>

@endsection