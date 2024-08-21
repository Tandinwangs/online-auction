<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'auction_reference_id',
        'status',
        'screenshot'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function auctionReference()
    {
        return $this->belongsTo(AuctionReference::class);
    }
    

}
