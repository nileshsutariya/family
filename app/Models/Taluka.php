<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taluka extends Model
{
    use HasFactory;

    protected $table = "taluka";
    protected $primaryKey = 'id';
    protected $fillable = [
        'district',
        'taluka'
    ];
    public function district()
    {
        return $this->belongsTo(District::class, 'district', 'id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
