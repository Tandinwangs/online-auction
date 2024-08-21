<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gewog extends Model
{
    use HasFactory;

    protected $fillable = [
        'gewogcode',
        'gewogname',
        'dzongcode'
    ];

    public function dzongkhag() {
        return $this->belongsTo(Dzongkhag::class, 'dzongcode');
    }

    public function villages()
    {
        return $this->hasMany(Village::class); 
    }

}
