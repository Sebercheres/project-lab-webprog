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
            <a href="/home">home</a>
            <a href="/movies">movies</a>
            <a href="/actors">actor</a>
            @auth
                <a href="/watchlist">My watchlist</a>
                <a href="/logout">logout</a>
            @endauth

            <a href="/login">login</a>
            <a href="/register">register</a>

        </div>
    </div>
</body>
</html>
