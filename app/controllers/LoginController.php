<?php

class LoginController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /login
     *
     * @return Response
     */
    public function index()
    {
        return View::make('login');
    }

    public function signup()
    {
        return View::make('signup');
    }

    public function store()
    {

        $user_info = Input::all();
      
        $user = new User;
        $user->first_name = $user_info['first_name'];
        $user->middle_name = $user_info['middle_name'];
        $user->last_name = $user_info['last_name'];
        $user->personal_email = $user_info['email'];
        $user->user_status = 0;

//        $save = $user->save();
        $save = 1;
        if ($save)
        {
            Mail::send('emails.welcome', ['user' => $user], function($message) use ($user)
            {
                $message->to($user->personal_email, 'EsparkInfo')->subject('Thank you for Registering.!');
            });
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function logout()
    {
        Auth::logout();
        return 1;
    }

    public function checklogin()
    {
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'), 'user_status' => 1)))
        {
            $permission = Permission::leftJoin('modules', 'modules.module_id', '=', 'permissions.page_id')
                            ->where('permissions.role_id', '=', Auth::user()->role_id)->get()->keyBy('page_id')->toArray();
            Session::set('permission', $permission);

            $data['permission'] = Permission::leftJoin('modules', 'modules.module_id', '=', 'permissions.page_id')
                            ->where('permissions.role_id', '=', Auth::user()->role_id)->get()->keyBy('module_controller')->toArray();
            $data['user'] = Auth::user();
            return $data;
        }
        else
        {
            return 0;
        }
    }

    public function setAngularPermission()
    {
        if (Auth::check())
        {
            $data['permission'] = Permission::leftJoin('modules', 'modules.module_id', '=', 'permissions.page_id')
                            ->where('permissions.role_id', '=', Auth::user()->role_id)->get()->keyBy('module_controller')->toArray();
            $data['user'] = Auth::user();
            return $data;
        }
        else
        {
            return 0;
        }
    }

    public function checkAuthentication()
    {
        if (Auth::check())
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function dashboard()
    {
        return View::make('dashboard');
    }

}
