<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer');
    }

    public function scopeThisWeek($query)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return $query->whereBetween('event_date', [$startOfWeek, $endOfWeek])
                     ->orderBy('event_date', 'asc'); 
    }
    
}









    // public function scopeThisWeek($query)
    // {
    //     $today = Carbon::today();

    //     $nextSixDays = $today->copy()->addDays(6);

    //     return $query->whereBetween('event_date', [$today, $nextSixDays])
    //                  ->orderBy('event_date', 'asc'); 
    // }