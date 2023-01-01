<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="">
        <div class="">
            movie list
        </div>
        <div>
            <a href="">home</a>
            <a href="">movies</a>
            <a href="">actor</a>
            @guest
                <a href="/login">login</a>
                <a href="/register">register</a>
            @endguest


            @auth
                <a href="">logout</a>
            @endauth
        </div>
    </div>
</body>
</html>
