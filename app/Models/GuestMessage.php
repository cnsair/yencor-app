<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'message'
    ];
    
    protected $casts = [
        'is_read' => 'boolean',
    ];
    
}
