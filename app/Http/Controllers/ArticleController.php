<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        //validate require
        $aryErr = [];
        if ($_REQUEST['title'] == '') {
            $aryErr[] = 'title is require';
        }
        if ($_REQUEST['content'] == '') {
            $aryErr[] = 'content is require';
        }

        if (!empty($aryErr)) {
            return redirect()->route('articles.create')
                ->with('errors', $aryErr);
        } else {
            Member::create($request->all());
            return redirect()->route('home')
                ->with('status','Article created successfully');

        }

    }

    public function show(Article $art)
    {
        return view('article.show', compact('art'));
    }

    public function edit(Article $art)
    {
        return view('article.edit', compact('art'));
    }

    public function update (Request $request, Article $art)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $art->update($request->all());
        return redirect()->route('home')
            ->with('status','Article updated successfully');
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return redirect()->route('home')
            ->with('status', 'Article deleted success');
    }
}
