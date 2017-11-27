<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // get User current login
use App\Comment;

class CommentController extends Controller
{
    public function add()
    {
    	$aryDataInsert = [
            'art_id' => $_REQUEST['art_id'],
            'content' => $_REQUEST['content'],
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
        ];
        Comment::create($aryDataInsert);
        $aryResponse = [
        	'status' => 1,
        ];

        return response ()->json ( $aryResponse );
    }

    public function loadcomment()
    {    	
    	$art_id = $_REQUEST['art_id'];
    	// get comment
        $listComment = Comment::where('art_id', $art_id)
                                ->where('is_deleted', 0)
                                // ->take(1)
                                ->orderBy('id', 'desc')
                                ->get();

        $returnHTML = view('article.listcomment')->with('listComment', $listComment)->render();
		return response()->json(['status' => 1, 'html'=>$returnHTML]);
    }
}
