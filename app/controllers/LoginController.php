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
        $rules = [
            'personal_email' => 'required|unique:users'
        ];
        $validator = Validator::make(['personal_email' => Input::get('email')], $rules);
        if ($validator->fails()) {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => $validator->messages()
            ]);
        } else {
            $user = new User;
            $user->first_name = $user_info['first_name'];
            $user->middle_name = $user_info['middle_name'];
            $user->last_name = $user_info['last_name'];
            $user->personal_email = $user_info['email'];
            $user->user_status = 0;

            $save = $user->save();
//            $save = 1;

            if ($save) {
                Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
                    $message->to($user->personal_email, $user->first_name)->subject('Welcome!');
                });
                return json_encode([
                    'code' => 200,
                    'msg' => 'Hr will contact you soon..!',
                    'result' => null
                ]);
            } else {
                return json_encode([
                    'code' => 403,
                    'msg' => Config::get('constants.error_record_msg'),
                    'result' => 'Something went wrong..!'
                ]);
            }
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

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'), 'user_status' => 1))) {
            $permission = Permission::leftJoin('modules', 'modules.module_id', '=', 'permissions.page_id')
                ->where('modules.is_inmenu', '=', 1)
                ->where('permissions.role_id', '=', Auth::user()->role_id)->get()->keyBy('page_id')->toArray();
            Session::set('permission', $permission);

            $data['permission'] = Permission::leftJoin('modules', 'modules.module_id', '=', 'permissions.page_id')
                ->where('modules.is_inmenu', '=', 1)
                ->where('permissions.role_id', '=', Auth::user()->role_id)->get()->keyBy('module_controller')->toArray();
            $data['user'] = Auth::user();
            return $data;
        } else {
            return 0;
        }
    }

    public function setAngularPermission()
    {
        if (Auth::check()) {
            $data['permission'] = Permission::leftJoin('modules', 'modules.module_id', '=', 'permissions.page_id')
                ->where('modules.is_inmenu', '=', 1)
                ->where('permissions.role_id', '=', Auth::user()->role_id)->get()->keyBy('module_controller')->toArray();
            $data['user'] = Auth::user();
            return $data;
        } else {
            return 0;
        }
    }

    public function checkAuthentication()
    {
        if (Auth::check()) {
            if (date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime(Auth::user()->ip_access_expire_time))) {
                return 1;
            } else {
                $ips = AllowedIp::lists('allowed_ips_name');
                if (!in_array('*', $ips)) { //globally allowed or not checked.. If * is in ip list it will allow all..
                    if (!in_array($_SERVER['REMOTE_ADDR'], $ips)) {
                        return 2;
                    }
                }
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function dashboard()
    {
        return View::make('dashboard');
    }

}
