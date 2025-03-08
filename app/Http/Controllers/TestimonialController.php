<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TestimonialController extends Controller
{
    // public function index()
    // {
    //     $testimonials = Testimonial::where('approved', true)->get();
    //     return view('testimonial.index', compact('testimonials'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'content' => 'required|string|max:300',
        ]);

        Testimonial::create([
            'name' => $request->name,
            'content' => $request->content,
            'approved' => false,
        ]);

        return redirect()->back()->with('success', 'Testimonial submitted for review');
    }

    public function create()
    {
        return view('home.add-testimonial');
    }

    public function adminIndex()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial', compact('testimonials'));
    }

    public function show(Testimonial $testimonial)
    {
        // Check if message exists
       if (!$testimonial) {
           return redirect()->back()->with('status', 'error');
        }

        return view('admin.read-testimonial', compact('testimonial'));
    }

    public function toggleApprove(Testimonial $testimonial)
    {
        // Check if message exists
        if (!$testimonial) {
           return redirect()->back()->with('status', 'error');
        }

        // Toggle the is_read status
        $testimonial->approved = !$testimonial->approved;
        $testimonial->update();

        // return redirect()->back()->with('status', 'success');
        return redirect()->back()->with([
            'status' => 'toggled',
            'approved_id' => $testimonial->id, // Store the updated row ID in the session
        ]);
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'success');
    }
}