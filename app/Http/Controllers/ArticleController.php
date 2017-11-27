<?php

namespace App\Http\Controllers;

use App\Like;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        if ($_REQUEST['art_title'] == '') {
            $aryErr[] = 'title is require';
        }
        if ($_REQUEST['art_content'] == '') {
            $aryErr[] = 'content is require';
        }

        if (!empty($aryErr)) {
            return redirect()->route('articles.create')
                ->with('errors', $aryErr);
        } else {
            $aryDataInsert = [
                'title' => $_REQUEST['art_title'],
                'content' => $_REQUEST['art_content'],
                'author' => Auth::user()->id,
                'author_name' => Auth::user()->name,
            ];
            Article::create($aryDataInsert);
            return redirect()->route('home')
                ->with('status','Article created successfully');

        }

    }

    public function show(Article $article)
    {
        // get comment
        $listComment = Comment::where('art_id', $article->id)
                                // ->take(1)
                                ->where('is_deleted', 0)
                                ->orderBy('id', 'desc')
                                ->get();

        // get like
        $like = Like::where('art_id',$article->id)
                        ->where ('user_id', Auth::user()->id)
                        ->take(1)
                        ->first();

        $isLike = 0;
        if (isset($like->id)) {
            $isLike = 1;
        }

        $aryResult = [
            'isLike' => $isLike,
            'listComment' => $listComment,
            'article' => $article
        ];

       return view('article.show', $aryResult);
    }

    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    public function update (Request $request, Article $article)
    {
        //validate require
        $aryErr = [];
        if ($_REQUEST['art_title'] == '') {
            $aryErr[] = 'title is require';
        }
        if ($_REQUEST['art_content'] == '') {
            $aryErr[] = 'content is require';
        }

        if (!empty($aryErr)) {
            return redirect()->route('articles.edit', $article->id)
                ->with('errors', $aryErr);
        } else {

            $aryDataUpdate = [
                'title' => $_REQUEST['art_title'],
                'content' => $_REQUEST['art_content'],
                'author' => Auth::user()->id,
                'author_name' => Auth::user()->name,
            ];

            $article->update($aryDataUpdate);
            return redirect()->route('home')
                ->with('status', 'Article updated successfully');
        }
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return redirect()->route('home')
            ->with('status', 'Article deleted success');
    }

    public function deletearticle()
    {
        $art_id = $_REQUEST['art_id'];
        $aryDataUpdate = [
            'is_deleted' => 1
        ];
        // delete article
        Article::where('id', '=', $art_id)
                ->update($aryDataUpdate);

        // delete comment
        Comment::where('art_id', '=', $art_id)
            ->update($aryDataUpdate);
        
        // delete like
        Like::where('art_id', '=', $art_id)
            ->delete();

        // response to client
        $aryResponse = [
            'status' => '1',
            'msg' => 'Article deleted success',
        ];
        return response ()->json ( $aryResponse );
        // return redirect()->route('home')
        //     ->with('status', 'Article deleted success');
    }
}
