<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ProfileController extends Controller
{
    //
    public function viewProfile($id){
    	
    	$posts = Post::where('user_id' , $id);
    	
    	return view('profile' , $posts);
    }
}
