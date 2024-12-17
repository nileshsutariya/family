<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;
    protected $table = 'village';
    protected $primaryKey = 'id';
    protected $fillable = [
        'district',
        'taluka',
        'village'
    ];
    public function taluka()
    {
        return $this->belongsTo(Taluka::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
