<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie['title'] }}</title>
    <style>
        body {
            margin:0;
            font-family: Arial;
            color:white;
            background:black;
        }

        .banner {
            height:400px;
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:end;
            padding:20px;
            background-image: linear-gradient(to top, black, transparent),
                url('{{ $movie["movie_banner"] ?? $movie["image"] }}');
        }

        .content {
            padding:30px;
            display:flex;
        }

        img {
            width:250px;
            border-radius:10px;
            margin-right:20px;
        }

        .desc {
            max-width:600px;
        }

        a {
            color:red;
        }
    </style>
</head>
<body>

<div class="banner">
    <h1>{{ $movie['title'] }}</h1>
</div>

<div class="content">
    <img src="{{ $movie['image'] }}">
    <div class="desc">
        <h2>{{ $movie['title'] }}</h2>
        <p>{{ $movie['description'] ?? 'Tidak ada deskripsi' }}</p>
        <p><b>Tahun:</b> {{ $movie['release_date'] }}</p>

        <br>
        <a href="/">⬅ Kembali</a>
    </div>
</div>

</body>
</html>