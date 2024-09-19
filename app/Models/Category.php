<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $fillables = [
    //     'name','parent_id','description','image','status','slug',
    // ] ;
    protected $guarded = [];
    use HasFactory;
}