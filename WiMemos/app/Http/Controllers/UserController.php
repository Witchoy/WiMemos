<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyUser;

class UserController extends Controller
{
    public function connect(Request $request) 
	{
        if ( empty($request->login) || empty($request->password) )
        {
            return to_route('view_Signin')->with('message','Some POST data are missing.');
        }
        $user = new MyUser($request->login,$request->password);
        try {
            if ( !($user->exists()) )
            {
                return to_route('view_Signin')->with('message','Wrong login/password.');
            }
        }
        catch (\PDOException $e) {
            return to_route(route: 'view_Signin')->with('message',$e->getMessage());
        }
        catch (\Exception $e) {
            return to_route('view_Signin')->with('message',$e->getMessage());
        }
        session(['user'=>$user]);
        return to_route('view_Account');
	}

    public function create(Request $request) 
    {
        if ( empty($request->login) || empty($request->password) || empty($request->password_confirmation) )
        {
            return to_route('view_Signup')->with('message', 'Some POST data are missing');
        }
        if ( $request->password !== $request->password_confirmation )
        {
            return to_route('view_Signup')->with('message', 'The two passwords differ');
        }
        $user = new MyUser($request->login,$request->password);
        try {
        if ($user->loginExists()) {
            return to_route('view_Signup')->with('message', 'This login is already taken.');
        }
        $user->create();
        } catch (\PDOException $e) {
            return to_route('view_Signup')->with('message', $e->getMessage());
        } catch (\Exception $e) {
            return to_route('view_Signup')->with('message', $e->getMessage());
        }
        session(['user'=>$user]);
        return to_route('view_Signin');
    }

    public function updatePassword(Request $request)
    {
        $login = session('user')->login();
        if ( empty($request->password) || empty($request->password_conf) )
        {
            return to_route('view_Formpassword')->with('message','Some POST data are missing');
        }
        if ( $request->password != $request->password_conf )
        {
            return to_route('view_Formpassword')->with('message','Error: passwords are different');
        }
        $user = new MyUser($login);
        try {
            $user->changePassword($request->password);
        }
        catch (\PDOException $e) {
            return to_route('view_Signin')->with('message',$e->getMessage());
        }
        catch (\Exception $e) {
            return to_route('view_Signin')->with('message',$e->getMessage());
        }
        session(['user'=>$user]);
        return to_route('view_Signin');
    }

    public function delete(Request $request)
    {
        $user = session('user');
        try {
            $user->delete();
        }
        catch (\PDOException $e) {
            return to_route('view_Signin')->with('message',$e->getMessage());
        }
        catch (\Exception $e) {
            return to_route('view_Signin')->with('message',$e->getMessage());
        }
        session()->flush();
        return to_route('view_Signin');
    }

    public function disconnect(Request $request) {
        session()->flush();
        return to_route('view_Signin');
    }
}
