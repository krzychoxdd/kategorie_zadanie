<?php

namespace App\Models;

use App\Events\CategoryCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class); 
    }
}
