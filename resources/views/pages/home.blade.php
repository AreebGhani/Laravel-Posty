@extends('app')
@section('content')

<nav class="bg-white p-2 m-3">
    <div class="row">
        <div class="col-3 text-left">
            <a href="{{ url('home') }}" class="p-3 font-weight-bold"><span class="pl-1 pr-1">Home</span></a>
            <a href="{{ url('dashboard') }}" class="p-3">Dashboard</a>
        </div>
        <div class="col-6"></div>
        <div class="col-3 text-right">
            @auth
            <a href="{{route('user', auth()->user()->id)}}" class="p-3 text-capitalize">{{auth()->user()->name}}</a>
            <a href="javascript:logout" id='logout_confirm' class="p-3">Logout</a>
            @endauth
            @guest
            <a href="{{ url('login') }}" class="p-3">Login</a>
            <a href="{{ url('register') }}" class="p-3">Register</a>
            @endguest
        </div>
    </div>
</nav>

<div class="row">
    <div class="col-sm-12 col-md-1 col-lg-1"></div>
    <div class="col-sm-12 col-md-10 col-lg-10">
        <h1 class="text-center container">All Posts</h1>
        @if(session('error'))
        <div class="text-center alert-danger"><span class="text-danger">{{ session('error') }}</span></div><br>
        @endif
        <div class="bg-white p-3">
            @if($posts->count())
            @foreach ($posts as $post)
            <div class="container m-1 mt-2 mb-2">
                <h4>{{$post->body}}</h4>
                <i class="font-weight-lighter ml-1" style="color:gray;font-size:14px;">By: <a class="text-capitalize" href="{{route('user', $post->user->id)}}">{{$post->user->name}}</a> — {{$post->created_at->diffForHumans()}}</i>
                <div class="font-weight-lighter ml-3 d-inline" style="font-size:12px;">
                    <span class="mr-1">[ {{$post->likes->count()}} ]</span>
                    <form class="d-inline" action="{{route('post/like')}}" method="post">
                        @csrf
                        <input name="post_id" value="{{$post->id}}" hidden>
                        <button id="like_button" type="submit" class="text-primary" style="border:none;background:none;cursor:pointer;">Like 👍</button>
                    </form>
                    |
                    <form class="d-inline" action="{{route('post/unlike')}}" method="post">
                        @csrf
                        <input name="post_id" value="{{$post->id}}" hidden>
                        <button id="like_button" type="submit" class="text-primary" style="border:none;background:none;cursor:pointer;">Unlike 👎</button>
                    </form>
                </div>
            </div>
            <hr>
            @endforeach
            <div class="font-weight-bold text-right ml-3" style="font-size:15px;">
                <span>Total Posts: @if($allposts->count()){{$allposts->count()}}@else 0 @endif</span>
            </div>
            <br>
            {{$posts->links()}}
            @else
            <div class="text-center alert-danger"><span class="text-danger">No Post Yet.</span></div>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-1 col-lg-1"></div>
</div>
<br>
<footer style="bottom:0;width:98%;@if($posts->count()<4)position:absolute;@endif" class="bg-white m-3 text-center">
    <p style="margin-bottom: -1px;">© <script>
            var date = new Date;
            document.write(date.getFullYear());
        </script> - All Rights Reserved. - <a href="{{url('home')}}"> Posty</a></p>
</footer>
@endsection