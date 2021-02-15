<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id', 'membership', 'name', 'surname', 'nickname', 'email', 'email_verified_at'
        ,'password', 'gender', 'province', 'city', 'address', 'postcode', 'phone'
        , 'user_photo', 'edad', 'birthdate'];

    protected $dates = ['birthdate'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ]; 

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; 

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function statu()
    {
        return $this->belongsTo(Statu::class,'status_id');
    }

    public function user_movements()
    {
        return $this->hasMany(User_movement::class);
    } 

    public function book_movements()
    {  
        return $this->hasOne(Book_movement::class);
    }

    public function getRoleNames()
    {
        return $this->roles->pluck('name')->implode(', ');
    }  

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // public function getRoleDisplayNames()
    // {
    //     return $this->roles->pluck('display_name')->implode(', ');
    // }  
}

