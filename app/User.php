<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Cashier\Billable;

use App\Mailers\AppMailers;



class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   use Billable;
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'url_count',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isSubscribed() {
            return $this->stripe_id;
    }

    /*public static  function boot()
>>>>>>> origin/final
    {
        parent::boot();

        static::creating(function($user){

        $user->email_token = str_random(30);

        });

    }

    public function confirmEmail()
    {

          $this->verified=1;

          $this->email_token=null;

          $this->save();
<<<<<<< HEAD
    }

=======
    }*/
}
