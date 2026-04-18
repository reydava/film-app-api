<!DOCTYPE html>
<html>
<head>
    <title>My Film</title>
    <style>
        body {
            margin:0;
            font-family: Arial;
            background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364);
            color:white;
        }

        h1 {
            text-align:center;
            padding:20px;
        }

        .search {
            text-align:center;
            margin-bottom:20px;
        }

        input {
            padding:10px;
            width:250px;
            border-radius:20px;
            border:none;
        }

        button {
            padding:10px 20px;
            border:none;
            border-radius:20px;
            background:red;
            color:white;
            cursor:pointer;
        }

        .container {
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
        }

        .card {
            width:200px;
            margin:15px;
            border-radius:10px;
            overflow:hidden;
            transition:0.3s;
            background:#111;
        }

        .card:hover {
            transform: scale(1.1);
        }

        .card img {
            width:100%;
            height:300px;
            object-fit:cover;
        }

        .title {
            padding:10px;
            font-weight:bold;
        }

        .year {
            padding:0 10px 10px;
            color:gray;
        }

        /* 🔥 ANIMASI BACKGROUND */
        body::before {
            content:"";
            position:fixed;
            width:200%;
            height:200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 10%, transparent 10%);
            background-size:50px 50px;
            animation: moveBg 20s linear infinite;
        }

        @keyframes moveBg {
            from { transform: translate(0,0); }
            to { transform: translate(-100px,-100px); }
        }
    </style>
</head>
<body>

<h1>🎬 My Film</h1>

<div class="search">
    <form action="/search">
        <input type="text" name="q" placeholder="Cari film...">
        <button>Cari</button>
    </form>
</div>

<div class="container">
    @foreach ($movies as $movie)
        <a href="/movie/{{ $movie['id'] ?? $movie['title'] }}" style="text-decoration:none; color:white;">
            <div class="card">
                <img src="{{ $movie['image'] ?? 'https://via.placeholder.com/300x450' }}">
                <div class="title">{{ $movie['title'] }}</div>
                <div class="year">{{ $movie['release_date'] ?? '-' }}</div>
            </div>
        </a>
    @endforeach
</div>

</body>
</html>