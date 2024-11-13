<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer');
    }

}
