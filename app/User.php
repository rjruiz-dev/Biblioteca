<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id', 'surname', 'nickname','email','email_verified_at'
        ,'password','gender','birthdate','address','postcode','phone'
        ,'user_photo'];
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
        return $this->hasMany(Book_movement::class);
    }
    
}

