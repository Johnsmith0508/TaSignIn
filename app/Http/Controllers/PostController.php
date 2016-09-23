<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    public function signout(Request $request)
    {
      $this->validate($request,[
        'stuNbr' => 'required'
      ]);
    }
}
