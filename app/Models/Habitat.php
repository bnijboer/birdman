<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitat extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function birds() {
        return $this->belongsToMany(Bird::class);
    }
}
