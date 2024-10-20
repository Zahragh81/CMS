<?php

namespace App\Models;

use App\Models\membership\File;
use App\Models\membership\Gender;
use App\Models\membership\Organization;
use App\Models\membership\SmsNotificationRecipient;
use App\Models\membership\Ticket;
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
        return $this->belongsTo(Organization::class);
    }


    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function avatar()
    {
        return $this->morphOne(File::class, 'model');
    }

    public function smsNotificationRecipients()
    {
        return $this->hasMany(SmsNotificationRecipient::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
