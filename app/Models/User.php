<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'elder',
        'elder_ph_no',
        'ph_no',
        'password',
        'first_name',
        'father_name',
        'mother_name',
        'last_name',
        'marital_status',
        'spouse_name',
        'email',
        'gender',
        'date_of_birth',
        'blood_group',
        'c_address',
        'c_district',
        'c_taluka',
        'c_village',
        'v_address',
        'v_district',
        'v_taluka',
        'v_village',
        'education',
        'profession',
        'company_name',
        'business_category',
        'profile_photo',
        'document_type',
        'document_upload',
        'approve_status',
        'parent_id',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function parent()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
    public function events()
    {
        return $this->hasMany(Events::class, 'organizer');
    }
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
