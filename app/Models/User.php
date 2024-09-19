<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $guard_name = 'api';
    protected $guarded = ['id'];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'password' => 'hashed'
    ];


    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizations_id');
    }


    public function gender()
    {
        return $this->belongsTo(Gender::class, 'genders_id');
    }

    public function avatar()
    {
        return $this->morphOne(File::class, 'model');
    }
}
