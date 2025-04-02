<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'riders';
    protected $fillable = [
       'user_id', 'vehicle', 'pick_up', 'destination', 'payment', 'completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, );
    }
}