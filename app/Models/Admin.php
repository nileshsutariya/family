<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $guard = 'admin';
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
    protected $hidden = ['password', 'remember_token'];

}
