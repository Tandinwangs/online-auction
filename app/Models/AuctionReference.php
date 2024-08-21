<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_reference_date'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

      public static function getRecentReferences($limit = 5)
{
    return self::latest('created_at')->limit($limit)->get();
}
}
