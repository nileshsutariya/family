<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'id';
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer', 'id'); 
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