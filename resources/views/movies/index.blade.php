<!DOCTYPE html>
<html>
<head>
    <title>My Film</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #141e30, #243b55);
            color: white;
        }

        .header {
            text-align: center;
            padding: 30px 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        input {
            padding: 10px;
            width: 250px;
            border-radius: 20px;
            border: none;
            outline: none;
        }

        button {
            padding: 10px 15px;
            border: none;
            background: red;
            color: white;
            border-radius: 20px;
            cursor: pointer;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* 🔥 ini bikin semua baris ke tengah */
            gap: 25px;
            padding: 20px;
}

        .card {
            width: 200px;
            background: #111;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .card:hover {
            transform: scale(1.07);
            box-shadow: 0 15px 35px rgba(0,0,0,0.8);
        }

        img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .title {
            padding: 10px;
            font-weight: bold;
        }

        .year {
            padding: 0 10px 15px;
            color: #aaa;
        }

        a {
            text-decoration: none;
            color: white;
        }

    </style>
</head>

<body>

<div class="header">
    <h1>🎬 My Film</h1>

    <form action="/search">
        <input type="text" name="q" placeholder="Cari film...">
        <button>Cari</button>
    </form>
</div>

<div class="container">
    @foreach ($movies as $movie)
        <a href="/movie/{{ $movie['id'] }}">
            <div class="card">
                <img src="{{ $movie['poster'] }}">
                <div class="title">{{ $movie['title'] }}</div>
                <div class="year">{{ $movie['year'] }}</div>
            </div>
        </a>
    @endforeach
</div>

</body>
</html>