<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\Like;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get list articles
        $articles = Article::where('is_deleted', '=', 0)
            ->orderBy('id', 'desc')
            ->take(10)
//            ->offset(11)
            ->get();

        return view('home', compact('articles'));
    }
}
