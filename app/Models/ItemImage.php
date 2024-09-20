<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'image_path'];

    // Define the relationship to the Item model
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
}
