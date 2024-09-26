<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function index()
    {
        $sheets = Sheet::all();

        for ($i = 0; $i < count($sheets); $i += 5) {
            $newSheets[] = $sheets->slice($i, 5)->values();
        }

        return view('sheet.index', ['sheets' => $newSheets]);
    }
}
