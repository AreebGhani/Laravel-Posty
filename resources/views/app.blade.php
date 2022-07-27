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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #like_button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<!-- body -->

<body style="background-color: lightgray;">

    @yield('content')

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
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
                $('#post_delete_confirm').submit();
            }
            a.preventDefault();
        });
    </script>
</body>

</html>