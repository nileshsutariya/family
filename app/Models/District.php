<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "district";
    protected $primaryKey = "id";
    protected $fillable = ['district'];
    public function talukas()
    {
        return $this->hasMany(Taluka::class, 'district', 'id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
