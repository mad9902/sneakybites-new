<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'travel_id',
        'rating',
        'comment',
        'image'
    ];

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the travel list that the review belongs to.
     */
    public function travel()
    {
        return $this->belongsTo(RestoList::class, 'travel_id');
    }
}
