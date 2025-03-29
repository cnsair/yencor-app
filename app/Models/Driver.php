<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle',
        'payment',
        'pick_up',
        'destination',
        'completed',
        'license_number',
        'status',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
