<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('order')->get();
        return view('web.team.index', compact('teams'));
    }
}
