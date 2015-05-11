<?php

class UsersController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function getIndexView()
    {
       return View::make('users.index');
    }

    public function getUserdataView()
    {
        $data['departments'] = Department::all();
        $data['users'] = User::all();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function getCreateAdd()
    {
        return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    public function getApproveEdit()
    {
        return View::make('users.approve_user');
    }

    public function getApproveDataEdit()
    {
        $users = User::where('user_status', '=', 0)->get();
        $data['aaData'] = $users;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val)
        {
            foreach ($val as $key1 => $val1)
            {
                $id = Helper::simple_encrypt($val1['user_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function getApproveChangeEdit()
    {
        return View::make('users.approve_change_user');
    }

    public function postFindChangeApproveEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data['department'] = Department::all();
        $data['designation'] = Designation::with('job_profiles')->get();

        $data['role'] = Role::all();
        $data['users'] = User::find($id);


        $data['users']->user_encrypted_id = Helper::simple_encrypt($data['users']->user_id);

        return Response::json($data);
    }

    public function postUpdateApproveEdit($id)
    {


        $id = Helper::simple_decrypt($id);
        $user = User::find($id);

        $user->department_id = Input::get('department_id');
        $user->designation_id = Input::get('designation_id');
        $user->job_profile = Input::get('job_profile');
        $user->role_id = Input::get('role_id');
        $user->email = Input::get('email');
        $user->employee_id = Input::get('employee_id');
        $user->doj =date('Y-m-d',  strtotime(Input::get('doj')));
        $user->password = Hash::make(Input::get('password'));
        $user->user_status = 1;

        $save = $user->save();
        $user->password1 = Input::get('password');

        if ($save)
        {
             Mail::send('emails.approved_user', ['user' => $user], function($message) use ($user)
                {
                    $message->to($user->email, $user->first_name)->subject('Welcome!');
                    $message->to($user->personal_email, $user->first_name)->subject('Welcome!');
                });
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => null
            ]);
        }
        else
        {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function getDestroyDelete($id)
    {
        $id = Helper::simple_decrypt($id);
        $user = User::find($id);

        $save = $user->delete();
        if ($save)
        {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.delete_record_msg'),
                'result' => null,
                'redirect' => 'app.users.approve'
            ]);
        }
        else
        {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null,
                'redirect' => 'app.users.approve'
            ]);
        }
    }

}
