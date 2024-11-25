<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taluka extends Model
{
    use HasFactory;

    protected $table = "taluka";
    protected $primaryKey = 'id';
}
