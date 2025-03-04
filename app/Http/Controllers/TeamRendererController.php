<?php

namespace App\Http\Controllers;

use App\Models\User;

class TeamRendererController extends Controller
{
    //Renders admin on the About homepage
    public function index(){
        $team_data = User::admins()->orderBy('id', 'desc')
                                ->limit(6)->get(); 

        return view('home.about')->with('team_data', $team_data);
    }
}
