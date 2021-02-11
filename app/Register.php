<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Register extends Model
{
    public static function checkUserExists($email) {
        $value = DB::table('users')->select('id')->where('email','=', $email)->first();
        return $value;
    }

    public static function get_users_data($user_id) {
        $value = DB::table('users')->select('id','name','role_id','email','phone')->where('id','!=', $user_id)->get()->toArray();
        return $value;
    }
}
