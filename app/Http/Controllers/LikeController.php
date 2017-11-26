<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // get User current login
use App\Like;

class LikeController extends Controller
{
    public function updatelike()
    {
    	$art_id = $_REQUEST['art_id'];
    	$value_like = $_REQUEST['like_new_value'];
    	$user_id = Auth::user()->id; 
    	
    	if ($value_like == 0) {
  			// case unlike
  			// delete all records like of art_id & user_id
  			$affectedRows = Like::where('art_id', '=', $art_id)
    								->where ('user_id', '=', $user_id)
    								->delete();
    	} else {
    		// case like
    		// create a new record like of user_id & art_id
    		$affectedRows = Like::create(
			    [
			    	'art_id' => $art_id,
			     	'user_id' => $user_id
				]
			);
    	}
    	// response to client
    	$aryResponse = [
    		'status' => '1',
    	];
    	return response ()->json ( $aryResponse );

    }
}
