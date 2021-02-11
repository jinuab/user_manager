<?php

namespace App\Http\Controllers;

use App\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    //storeUser
    public function storeUser(Request $request)
    {
        $name = $request->name;
        $password = Hash::make($request->password);
        $email = $request->email;
        $phone = $request->phone;
        $user_role = $request->user_role;

        $user_exists_check = Register::checkUserExists($email);
        if(!empty($user_exists_check))
        {
            return response()->json(['status' => 'AE','message'=>'Email address already taken. Please try another one.']);
        }

        $now = now();
        $status = DB::table('users')->insert([
                'name'=>$name,
                'password'=>$password,
                'email'=>$email,
                'phone'=>$phone,
                'role_id'=>$user_role,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );
        if($status==1)
        {
            return response()->json(['status' => 'success','message'=>'User is successfully created!']);
        }
    }

    public function login()
    {
        //check if authenticate && second is condition when we need to redirect i.e,
        if(Auth::check())
        {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $email = $request->login_email;
        $password = $request->login_password;

        $credentials = array(
            "email" => $email,
            "password" => $password
        );

        if (Auth::attempt($credentials)) {
            return response()->json(['status' => 'success','message'=>'User credentials correct!']);
        }

        return response()->json(['status' => 'invalid','message'=>'Credentials do not match, please try again!']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function home()
    {
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $name = Auth::user()->name;
            $role_id = Auth::user()->role_id;
            if($role_id==1) {
                $users_data = Register::get_users_data($user_id);
            } else {
                $users_data = '';
            }
        } else {
            $users_data = '';
            $role_id = '';
            $name = '';
        }

        return view('home', ['name'=>$name, 'role_id'=>$role_id,'users_data' => $users_data]);
    }

    public function delete_user(Request $request)
    {
        $user_id = $request->id;
        if($user_id!= '')
        {
           $delete_query = DB::table('users')->delete($user_id);
           if($delete_query==1)
           {
               return response()->json(['status' => 'success','message'=>'User was successfully deleted!']);
           }
        }

        return response()->json(['status' => 'failed','message'=>'User could not be deleted!']);
    }
}
