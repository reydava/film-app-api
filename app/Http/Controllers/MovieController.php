<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    // 🎬 GET DATA API + BACKUP
    private function getMovies()
    {
        try {
            $response = Http::timeout(5)->get('https://ghibliapi.vercel.app/films');

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            // fallback kalau API error
        }

        // 🔥 DATA CADANGAN
        return [
            [
                'id' => 1,
                'title' => 'Spirited Away',
                'description' => 'Seorang gadis masuk ke dunia roh.',
                'release_date' => '2001',
                'image' => 'https://image.tmdb.org/t/p/w500/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg',
                'movie_banner' => 'https://image.tmdb.org/t/p/original/mnDvPokXpvsdPcWSjNRPhiiLOKu.jpg'
            ],
            [
                'id' => 2,
                'title' => 'My Neighbor Totoro',
                'description' => 'Petualangan dua anak dengan makhluk hutan.',
                'release_date' => '1988',
                'image' => 'https://image.tmdb.org/t/p/w500/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg',
                'movie_banner' => 'https://image.tmdb.org/t/p/original/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Howl’s Moving Castle',
                'description' => 'Kastil berjalan penuh sihir.',
                'release_date' => '2004',
                'image' => 'https://image.tmdb.org/t/p/w500/TkTPELv4kC3u1lkloush8skOjE.jpg',
                'movie_banner' => 'https://image.tmdb.org/t/p/original/TkTPELv4kC3u1lkloush8skOjE.jpg'
            ]
        ];
    }

    // 🔥 BERANDA
    public function index()
    {
        $movies = $this->getMovies();
        return view('movies.index', compact('movies'));
    }

    // 🔥 DETAIL
    public function detail($id)
    {
        $movies = collect($this->getMovies());

        $movie = $movies->firstWhere('id', $id)
            ?? $movies->firstWhere('title', $id)
            ?? $movies->first();

        return view('movies.detail', compact('movie'));
    }

    // 🔥 SEARCH
    public function search(Request $request)
    {
        $query = strtolower($request->q);

        $movies = collect($this->getMovies())->filter(function ($movie) use ($query) {
            return str_contains(strtolower($movie['title']), $query);
        });

        return view('movies.index', ['movies' => $movies]);
    }
}