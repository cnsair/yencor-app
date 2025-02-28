<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class AdminDashboardRendererController extends \App\Http\Controllers\Controller
{
    //Controller that renders posted items
    public function dashboardRenderer(){
        // where('type', 1)
        $user_data = User::query()->orderBy('id', 'desc')
                                    ->limit(50)->get();      

        return view('admin.dashboard')
            ->with('user_data', $user_data);
    }
}
