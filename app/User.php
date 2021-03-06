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
        'fname', 'lname', 'uname' ,'password','role_id','department_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['full_name', 'group'];
  
    public function getFullNameAttribute(){
        return  ucfirst($this->lName) . ', ' . ucfirst($this->fName);
    }
    
}
