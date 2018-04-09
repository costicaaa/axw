<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    public static function createNewUser($input)
    {
        $new_user = new User();
        $new_user->name = $input['name'];
        $new_user->email = $input['email'];
        $new_user->password = Hash::make($input['password']);
        $new_user->matricola = self::generateUniqueMatricola();
        $new_user->save();
        return $new_user->id;

    }

    public static function generateUniqueMatricola()
    {
        while(1)
        {
            $matricola = uniqid("id_");
            $check_exists = self::where("matricola", $matricola)->first();
            if(!$check_exists)
            {
                return $matricola;
            }
        }
    }
}
