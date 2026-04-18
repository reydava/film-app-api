<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    private function getMovies()
    {
        try {
            $response = Http::timeout(5)->get('https://ghibliapi.vercel.app/films');

            if ($response->successful()) {
                $data = $response->json();

                return collect($data)->map(function ($movie, $index) {
                    return [
                        'id' => $movie['id'] ?? $index,
                        'title' => $movie['title'] ?? 'No Title',
                        'overview' => $movie['description'] ?? 'No Description',
                        'year' => $movie['release_date'] ?? 'Unknown',

                        // 🔥 GAMBAR FIX
                        'poster' => !empty($movie['image'])
                            ? $movie['image']
                            : 'https://source.unsplash.com/300x450/?movie,' . rand(1,100),

                        'banner' => !empty($movie['movie_banner'])
                            ? $movie['movie_banner']
                            : 'https://source.unsplash.com/1200x500/?cinema,' . rand(1,100),
                    ];
                })->toArray();
            }
        } catch (\Exception $e) {}

        // 🔥 FALLBACK
        return [
            [
                'id'=>1,
                'title'=>'Spirited Away',
                'overview'=>'Seorang gadis masuk ke dunia roh.',
                'year'=>'2001',
                'poster'=>'https://image.tmdb.org/t/p/w500/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg',
                'banner'=>'https://image.tmdb.org/t/p/original/mnDvPokXpvsdPcWSjNRPhiiLOKu.jpg'
            ],
            [
                'id'=>2,
                'title'=>'My Neighbor Totoro',
                'overview'=>'Petualangan dua anak dengan makhluk hutan.',
                'year'=>'1988',
                'poster'=>'https://image.tmdb.org/t/p/w500/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg',
                'banner'=>'https://image.tmdb.org/t/p/original/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg'
            ]
        ];
    }

    public function index()
    {
        $movies = $this->getMovies();
        return view('movies.index', compact('movies'));
    }

    public function detail($id)
    {
        $movies = collect($this->getMovies());
        $movie = $movies->firstWhere('id', $id) ?? $movies->first();

        return view('movies.detail', compact('movie'));
    }

    public function search(Request $request)
    {
        $query = strtolower($request->q);

        $movies = collect($this->getMovies())->filter(function ($movie) use ($query) {
            return str_contains(strtolower($movie['title']), $query);
        });

        return view('movies.index', ['movies' => $movies]);
    }
}