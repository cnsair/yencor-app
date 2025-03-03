<?php

namespace App\Http\Controllers;

use App\Models\User;

class TeamRendererController extends Controller
{
    //Controller that renders posted items
    public function index(){
        $team_data = User::admins()->orderBy('id', 'desc')
                                ->limit(6)->get();
                                // $testimony_section = Testimony::where('approved', true)->get();   

        return view('home.about')->with('team_data', $team_data);
    }
}
