<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function sample ()
    {
        return response('practice');
    }

    public function sample2 ()
    {
        $test = 'practice2';
        return response($test);
    }

    public function sample3 ()
    {
        $test = 'test';
        return response($test);
    }
}
