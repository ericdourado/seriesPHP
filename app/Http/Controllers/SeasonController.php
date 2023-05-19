<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(Serie $series)
    {
        $count = 0;
        $seasons = $series->seasons()->with('episodes')->get();
        return view('seasons.index')->with('seasons', $seasons)->with('series', $series)->with('count',$count);
    }
}
