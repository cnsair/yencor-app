<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('approved', true)->get();
        return view('testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Testimonial::create([
            'name' => $request->name,
            'content' => $request->content,
            'approved' => false,
        ]);

        return redirect()->back()->with('success', 'Testimonial submitted for review.');
    }

    public function create()
    {

        return view('home.add-testimonial');
    }

    public function adminIndex()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials', compact('testimonials'));
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['approved' => true]);

        return redirect()->back()->with('success', 'Testimonial approved.');
    }

    public function reject($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Testimonial rejected.');
    }
}