<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AdminDriver extends Model
{
    use HasFactory;

    protected $table = 'admin_driver';
    
    protected $fillable = [
        'user_id',
        'vehicle',
        'payment',
        'pick_up',
        'destination',
        'completed',
        'license_number', // Added new column
        'status', // Added new column
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
