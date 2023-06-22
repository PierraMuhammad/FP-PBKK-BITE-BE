<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "quantity",
        "total",
        "status"
    ];

    public function food(){
        return $this->belongsTo(Food::class);
    }
}
