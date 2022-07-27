<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Posty</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        #like_button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<!-- body -->

<body style="background-color: lightgray;">

    <nav class="bg-white p-2 m-3">
        <div class="row">
            <div class="col-3 text-left">
                <a href="{{ url('home') }}" class="p-3">Home</a>
                <a href="{{ url('dashboard') }}" class="p-3">Dashboard</a>
            </div>
            <div class="col-6"></div>
            <div class="col-3 text-right">
                @auth
                <a href="{{route('user', auth()->user()->id)}}" class="p-3 font-weight-bold"><span class="pl-1 pr-1 text-capitalize">{{auth()->user()->name}}</span></a>
                <a href="" id='logout_confirm' class="p-3">Logout</a>
                @endauth
                @guest
                <a href="{{ url('login') }}" class="p-3">Login</a>
                <a href="{{ url('register') }}" class="p-3">Register</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-12"></div>
        <div class="col-lg-10 col-md-10 col-sm-12 mt-3 md-3">
            <div class="bg-white p-3">
                @if($user)
                <h3 class="text-center text-capitalize">
                    {{$user->name}}
                </h3>
                <br>
                @if($posts)
                <table class="table table-sm table-bordered text-center text-capitalize table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Posts</th>
                            <th>Likes</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sum = 0 ?>
                        @foreach($posts as $index=>$post)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$post->body}}</td>
                            <td>{{$post->likes->count()}}</td>
                            <?php $sum += $post->likes->count(); ?>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <p><span class="text-capitalize">{{$user->name}}</span> has posted <b> {{$user->posts->count()}} @if($user->posts->count()<1) post @else {{Str::plural('post',$user->posts->count())}} @endif</b> and got <b>{{$sum}} @if($sum<1) like. @else {{Str::plural('like',$sum)}}. @endif</b></p>
                @endif
                @endif
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-12"></div>
    </div>
    <footer style="bottom:0;width:98%;@if($posts->count()<7)position:absolute;@endif" class="bg-white m-3 text-center">
        <p style="margin-bottom: -1px;">© <script>
                var date = new Date;
                document.write(date.getFullYear());
            </script> - All Rights Reserved. - <a href="{{url('home')}}"> Posty</a></p>
    </footer>

    <!-- Javascript files-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script>
        $('#logout_confirm').click(function(a) {
            var e = confirm('Do you want to Logout . . . ?');
            if (e) {
                window.location.href = "{{route('logout')}}";
            }
            a.preventDefault();
        });
        $('#post_delete_confirm div').click(function(a) {
            e = confirm('Do you want to delete this post . . . ?');
            if (e) {
                $('##post_delete_confirm').submit();
            }
            a.preventDefault();
        });
    </script>
</body>

</html>