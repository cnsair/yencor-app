<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials'; // Ensures Laravel uses the correct table
    
    protected $fillable = ['name', 'content', 'approved', 'comp_position', 'email', 'testimonial', 'user_id'];

}
