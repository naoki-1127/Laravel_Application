<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function upload_box(Request $request){
        dd($request->all());
    }
}
