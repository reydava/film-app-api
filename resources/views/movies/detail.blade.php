<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie['title'] }}</title>
    <style>
        body {
            margin:0;
            font-family: Arial;
            color:white;
            background:url('{{ $movie['banner'] }}') no-repeat center/cover;
        }

        .overlay {
            background:rgba(0,0,0,0.7);
            min-height:100vh;
            padding:50px;
        }

        .box {
            display:flex;
            gap:30px;
        }

        img {
            width:300px;
            border-radius:10px;
        }

        .info {
            max-width:600px;
        }

        a {
            color:red;
        }
    </style>
</head>
<body>

<div class="overlay">
    <a href="/">⬅ Kembali</a>

    <div class="box">
        <img src="{{ $movie['poster'] }}">

        <div class="info">
            <h1>{{ $movie['title'] }}</h1>
            <p><b>Tahun:</b> {{ $movie['year'] }}</p>
            <p>{{ $movie['overview'] }}</p>
        </div>
    </div>
</div>

</body>
</html>