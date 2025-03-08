<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class HomeRendererController extends Controller
{
    public function index(){

        $testimonials = Testimonial::where('approved', true)
                        ->limit(10)->get(); 
        return view('home.home', compact('testimonials'));
        
    }
}
