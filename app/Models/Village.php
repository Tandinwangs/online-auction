<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'villcode',
        'villname',
        'gewocode'
    ];

    public function gewog() {
        return $this->belongsTo(Gewog::class, 'gewocode');
    }
}
