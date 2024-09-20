<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'starting_bid',
        'current_bid',
        'reserve_price',
        'category_id',
        'auction_reference_id',
        'user_id',
        'status',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function auctionReference()
    {
        return $this->belongsTo(AuctionReference::class);
    }
    
    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }
    
}
