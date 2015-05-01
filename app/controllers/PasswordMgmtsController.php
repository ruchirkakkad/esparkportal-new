<?php

class PasswordMgmtsController extends \BaseController {

    public function getIndexView()
    {
        return View::make('password_mgmts.index');
    }

    public function getIndexdataView()
    {
        if(Auth::user()->role_id != Config::get('constants.marketing_admin_id'))
        {
            $user_id = Auth::user()->user_id;
            $data1 = PasswordMgmt::select('password_mgmts_id','project_name','live_f_url','live_b_url')->where('user_ids','LIKE',"%$user_id%")->get();
        }
        else{
            $data1 = PasswordMgmt::select('password_mgmts_id','project_name','live_f_url','live_b_url')->get();
        }
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['password_mgmts_id']);
                $returndata[$key][$key1]['project_name'] = Helper::simple_decrypt($returndata[$key][$key1]['project_name']);
                $returndata[$key][$key1]['live_f_url'] = Helper::simple_decrypt($returndata[$key][$key1]['live_f_url']);
                $returndata[$key][$key1]['live_b_url'] = Helper::simple_decrypt($returndata[$key][$key1]['live_b_url']);

                $returndata[$key][$key1]['edit'] = $id;
            }
        }
        return $returndata;
    }

    public function getCreateAdd()
    {
        return View::make('password_mgmts.create');
    }

    public function postFetchUsersAdd()
    {
        $data['users_data'] = User::select('first_name','user_id')->get();
        return $data;
    }

    public function postStoreAdd()
    {
        $data = new PasswordMgmt();
        $data->user_ids = json_encode(Input::get('user_ids'));

        $data->project_name = Helper::simple_encrypt(Input::get('project_name'));
        $data->live_f_url = Helper::simple_encrypt(Input::get('live_f_url'));
        $data->live_b_url = Helper::simple_encrypt(Input::get('live_b_url'));
        $data->live_b_username1 = Helper::simple_encrypt(Input::get('live_b_username1'));
        $data->live_b_password1 = Helper::simple_encrypt(Input::get('live_b_password1'));
        $data->live_b_username2 = Helper::simple_encrypt(Input::get('live_b_username2'));
        $data->live_b_password2 = Helper::simple_encrypt(Input::get('live_b_password2'));
        $data->live_b_username3 = Helper::simple_encrypt(Input::get('live_b_username3'));
        $data->live_b_password3 = Helper::simple_encrypt(Input::get('live_b_password3'));
        $data->live_c_url = Helper::simple_encrypt(Input::get('live_c_url'));
        $data->live_c_username = Helper::simple_encrypt(Input::get('live_c_username'));
        $data->live_c_password = Helper::simple_encrypt(Input::get('live_c_password'));
        $data->live_ftp_host = Helper::simple_encrypt(Input::get('live_ftp_host'));
        $data->live_ftp_port = Helper::simple_encrypt(Input::get('live_ftp_port'));
        $data->live_ftp_username = Helper::simple_encrypt(Input::get('live_ftp_username'));
        $data->live_ftp_password = Helper::simple_encrypt(Input::get('live_ftp_password'));
        $data->stagging_f_url = Helper::simple_encrypt(Input::get('stagging_f_url'));
        $data->stagging_b_url = Helper::simple_encrypt(Input::get('stagging_b_url'));
        $data->stagging_b_username1 = Helper::simple_encrypt(Input::get('stagging_b_username1'));
        $data->stagging_b_password1 = Helper::simple_encrypt(Input::get('stagging_b_password1'));
        $data->stagging_b_username2 = Helper::simple_encrypt(Input::get('stagging_b_username2'));
        $data->stagging_b_password2 = Helper::simple_encrypt(Input::get('stagging_b_password2'));
        $data->stagging_b_username3 = Helper::simple_encrypt(Input::get('stagging_b_username3'));
        $data->stagging_b_password3 = Helper::simple_encrypt(Input::get('stagging_b_password3'));
        $data->stagging_c_url = Helper::simple_encrypt(Input::get('stagging_c_url'));
        $data->stagging_c_username = Helper::simple_encrypt(Input::get('stagging_c_username'));
        $data->stagging_c_password = Helper::simple_encrypt(Input::get('stagging_c_password'));
        $data->stagging_ftp_host = Helper::simple_encrypt(Input::get('stagging_ftp_host'));
        $data->stagging_ftp_port = Helper::simple_encrypt(Input::get('stagging_ftp_port'));
        $data->stagging_ftp_username = Helper::simple_encrypt(Input::get('stagging_ftp_username'));
        $data->stagging_ftp_password = Helper::simple_encrypt(Input::get('stagging_ftp_password'));
        $data->ourserver_f_url = Helper::simple_encrypt(Input::get('ourserver_f_url'));
        $data->ourserver_b_url = Helper::simple_encrypt(Input::get('ourserver_b_url'));
        $data->ourserver_b_username1 = Helper::simple_encrypt(Input::get('ourserver_b_username1'));
        $data->ourserver_b_password1 = Helper::simple_encrypt(Input::get('ourserver_b_password1'));
        $data->ourserver_b_username2 = Helper::simple_encrypt(Input::get('ourserver_b_username2'));
        $data->ourserver_b_password2 = Helper::simple_encrypt(Input::get('ourserver_b_password2'));
        $data->ourserver_b_username3 = Helper::simple_encrypt(Input::get('ourserver_b_username3'));
        $data->ourserver_b_password3 = Helper::simple_encrypt(Input::get('ourserver_b_password3'));
        $data->ourserver_c_url = Helper::simple_encrypt(Input::get('ourserver_c_url'));
        $data->ourserver_c_username = Helper::simple_encrypt(Input::get('ourserver_c_username'));
        $data->ourserver_c_password = Helper::simple_encrypt(Input::get('ourserver_c_password'));
        $data->ourserver_ftp_host = Helper::simple_encrypt(Input::get('ourserver_ftp_host'));
        $data->ourserver_ftp_port = Helper::simple_encrypt(Input::get('ourserver_ftp_port'));
        $data->ourserver_ftp_username = Helper::simple_encrypt(Input::get('ourserver_ftp_username'));
        $data->ourserver_ftp_password = Helper::simple_encrypt(Input::get('ourserver_ftp_password'));

        $save = $data->save();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }

    public function getShowView()
    {
        return View::make('password_mgmts.show');
    }


    public function postShowFindView($id)
    {
        $id = Helper::simple_decrypt($id);

        $data1 = PasswordMgmt::find($id);

        $returndata = json_decode(json_encode($data1), true);

        $returndata['user_ids'] = User::select('first_name','user_id')->whereIn('user_id',json_decode($returndata['user_ids']))->get();

        $returndata['project_name'] = Helper::simple_decrypt($returndata['project_name']);
        $returndata['live_f_url'] = Helper::simple_decrypt($returndata['live_f_url']);
        $returndata['live_b_url'] = Helper::simple_decrypt($returndata['live_b_url']);
        $returndata['live_b_username1'] = Helper::simple_decrypt($returndata['live_b_username1']);
        $returndata['live_b_password1'] = Helper::simple_decrypt($returndata['live_b_password1']);
        $returndata['live_b_username2'] = Helper::simple_decrypt($returndata['live_b_username2']);
        $returndata['live_b_password2'] = Helper::simple_decrypt($returndata['live_b_password2']);
        $returndata['live_b_username3'] = Helper::simple_decrypt($returndata['live_b_username3']);
        $returndata['live_b_password3'] = Helper::simple_decrypt($returndata['live_b_password3']);
        $returndata['live_c_url'] = Helper::simple_decrypt($returndata['live_c_url']);
        $returndata['live_c_username'] = Helper::simple_decrypt($returndata['live_c_username']);
        $returndata['live_c_password'] = Helper::simple_decrypt($returndata['live_c_password']);
        $returndata['live_ftp_host'] = Helper::simple_decrypt($returndata['live_ftp_host']);
        $returndata['live_ftp_port'] = Helper::simple_decrypt($returndata['live_ftp_port']);
        $returndata['live_ftp_username'] = Helper::simple_decrypt($returndata['live_ftp_username']);
        $returndata['live_ftp_password'] = Helper::simple_decrypt($returndata['live_ftp_password']);
        $returndata['stagging_f_url'] = Helper::simple_decrypt($returndata['stagging_f_url']);
        $returndata['stagging_b_url'] = Helper::simple_decrypt($returndata['stagging_b_url']);
        $returndata['stagging_b_username1'] = Helper::simple_decrypt($returndata['stagging_b_username1']);
        $returndata['stagging_b_password1'] = Helper::simple_decrypt($returndata['stagging_b_password1']);
        $returndata['stagging_b_username2'] = Helper::simple_decrypt($returndata['stagging_b_username2']);
        $returndata['stagging_b_password2'] = Helper::simple_decrypt($returndata['stagging_b_password2']);
        $returndata['stagging_b_username3'] = Helper::simple_decrypt($returndata['stagging_b_username3']);
        $returndata['stagging_b_password3'] = Helper::simple_decrypt($returndata['stagging_b_password3']);
        $returndata['stagging_c_url'] = Helper::simple_decrypt($returndata['stagging_c_url']);
        $returndata['stagging_c_username'] = Helper::simple_decrypt($returndata['stagging_c_username']);
        $returndata['stagging_c_password'] = Helper::simple_decrypt($returndata['stagging_c_password']);
        $returndata['stagging_ftp_host'] = Helper::simple_decrypt($returndata['stagging_ftp_host']);
        $returndata['stagging_ftp_port'] = Helper::simple_decrypt($returndata['stagging_ftp_port']);
        $returndata['stagging_ftp_username'] = Helper::simple_decrypt($returndata['stagging_ftp_username']);
        $returndata['stagging_ftp_password'] = Helper::simple_decrypt($returndata['stagging_ftp_password']);
        $returndata['ourserver_f_url'] = Helper::simple_decrypt($returndata['ourserver_f_url']);
        $returndata['ourserver_b_url'] = Helper::simple_decrypt($returndata['ourserver_b_url']);
        $returndata['ourserver_b_username1'] = Helper::simple_decrypt($returndata['ourserver_b_username1']);
        $returndata['ourserver_b_password1'] = Helper::simple_decrypt($returndata['ourserver_b_password1']);
        $returndata['ourserver_b_username2'] = Helper::simple_decrypt($returndata['ourserver_b_username2']);
        $returndata['ourserver_b_password2'] = Helper::simple_decrypt($returndata['ourserver_b_password2']);
        $returndata['ourserver_b_username3'] = Helper::simple_decrypt($returndata['ourserver_b_username3']);
        $returndata['ourserver_b_password3'] = Helper::simple_decrypt($returndata['ourserver_b_password3']);
        $returndata['ourserver_c_url'] = Helper::simple_decrypt($returndata['ourserver_c_url']);
        $returndata['ourserver_c_username'] = Helper::simple_decrypt($returndata['ourserver_c_username']);
        $returndata['ourserver_c_password'] = Helper::simple_decrypt($returndata['ourserver_c_password']);
        $returndata['ourserver_ftp_host'] = Helper::simple_decrypt($returndata['ourserver_ftp_host']);
        $returndata['ourserver_ftp_port'] = Helper::simple_decrypt($returndata['ourserver_ftp_port']);
        $returndata['ourserver_ftp_username'] = Helper::simple_decrypt($returndata['ourserver_ftp_username']);
        $returndata['ourserver_ftp_password'] = Helper::simple_decrypt($returndata['ourserver_ftp_password']);



        $data['password_mgmts'] = $returndata;
        $data['users_data'] = User::select('first_name','user_id')->get();
        return Response::json($data);
    }

    public function getEditEdit()
    {
        return View::make('password_mgmts.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data1 = PasswordMgmt::find($id);

        $returndata = json_decode(json_encode($data1), true);

        $returndata['password_mgmts_id'] = Helper::simple_encrypt($returndata['password_mgmts_id']);

        $returndata['user_ids'] = User::select('first_name','user_id')->whereIn('user_id',json_decode($returndata['user_ids']))->get();

        $returndata['project_name'] = Helper::simple_decrypt($returndata['project_name']);
        $returndata['live_f_url'] = Helper::simple_decrypt($returndata['live_f_url']);
        $returndata['live_b_url'] = Helper::simple_decrypt($returndata['live_b_url']);
        $returndata['live_b_username1'] = Helper::simple_decrypt($returndata['live_b_username1']);
        $returndata['live_b_password1'] = Helper::simple_decrypt($returndata['live_b_password1']);
        $returndata['live_b_username2'] = Helper::simple_decrypt($returndata['live_b_username2']);
        $returndata['live_b_password2'] = Helper::simple_decrypt($returndata['live_b_password2']);
        $returndata['live_b_username3'] = Helper::simple_decrypt($returndata['live_b_username3']);
        $returndata['live_b_password3'] = Helper::simple_decrypt($returndata['live_b_password3']);
        $returndata['live_c_url'] = Helper::simple_decrypt($returndata['live_c_url']);
        $returndata['live_c_username'] = Helper::simple_decrypt($returndata['live_c_username']);
        $returndata['live_c_password'] = Helper::simple_decrypt($returndata['live_c_password']);
        $returndata['live_ftp_host'] = Helper::simple_decrypt($returndata['live_ftp_host']);
        $returndata['live_ftp_port'] = Helper::simple_decrypt($returndata['live_ftp_port']);
        $returndata['live_ftp_username'] = Helper::simple_decrypt($returndata['live_ftp_username']);
        $returndata['live_ftp_password'] = Helper::simple_decrypt($returndata['live_ftp_password']);
        $returndata['stagging_f_url'] = Helper::simple_decrypt($returndata['stagging_f_url']);
        $returndata['stagging_b_url'] = Helper::simple_decrypt($returndata['stagging_b_url']);
        $returndata['stagging_b_username1'] = Helper::simple_decrypt($returndata['stagging_b_username1']);
        $returndata['stagging_b_password1'] = Helper::simple_decrypt($returndata['stagging_b_password1']);
        $returndata['stagging_b_username2'] = Helper::simple_decrypt($returndata['stagging_b_username2']);
        $returndata['stagging_b_password2'] = Helper::simple_decrypt($returndata['stagging_b_password2']);
        $returndata['stagging_b_username3'] = Helper::simple_decrypt($returndata['stagging_b_username3']);
        $returndata['stagging_b_password3'] = Helper::simple_decrypt($returndata['stagging_b_password3']);
        $returndata['stagging_c_url'] = Helper::simple_decrypt($returndata['stagging_c_url']);
        $returndata['stagging_c_username'] = Helper::simple_decrypt($returndata['stagging_c_username']);
        $returndata['stagging_c_password'] = Helper::simple_decrypt($returndata['stagging_c_password']);
        $returndata['stagging_ftp_host'] = Helper::simple_decrypt($returndata['stagging_ftp_host']);
        $returndata['stagging_ftp_port'] = Helper::simple_decrypt($returndata['stagging_ftp_port']);
        $returndata['stagging_ftp_username'] = Helper::simple_decrypt($returndata['stagging_ftp_username']);
        $returndata['stagging_ftp_password'] = Helper::simple_decrypt($returndata['stagging_ftp_password']);
        $returndata['ourserver_f_url'] = Helper::simple_decrypt($returndata['ourserver_f_url']);
        $returndata['ourserver_b_url'] = Helper::simple_decrypt($returndata['ourserver_b_url']);
        $returndata['ourserver_b_username1'] = Helper::simple_decrypt($returndata['ourserver_b_username1']);
        $returndata['ourserver_b_password1'] = Helper::simple_decrypt($returndata['ourserver_b_password1']);
        $returndata['ourserver_b_username2'] = Helper::simple_decrypt($returndata['ourserver_b_username2']);
        $returndata['ourserver_b_password2'] = Helper::simple_decrypt($returndata['ourserver_b_password2']);
        $returndata['ourserver_b_username3'] = Helper::simple_decrypt($returndata['ourserver_b_username3']);
        $returndata['ourserver_b_password3'] = Helper::simple_decrypt($returndata['ourserver_b_password3']);
        $returndata['ourserver_c_url'] = Helper::simple_decrypt($returndata['ourserver_c_url']);
        $returndata['ourserver_c_username'] = Helper::simple_decrypt($returndata['ourserver_c_username']);
        $returndata['ourserver_c_password'] = Helper::simple_decrypt($returndata['ourserver_c_password']);
        $returndata['ourserver_ftp_host'] = Helper::simple_decrypt($returndata['ourserver_ftp_host']);
        $returndata['ourserver_ftp_port'] = Helper::simple_decrypt($returndata['ourserver_ftp_port']);
        $returndata['ourserver_ftp_username'] = Helper::simple_decrypt($returndata['ourserver_ftp_username']);
        $returndata['ourserver_ftp_password'] = Helper::simple_decrypt($returndata['ourserver_ftp_password']);

        $data['password_mgmts'] = $returndata;
        $data['users_data'] = User::select('first_name','user_id')->get();
        return Response::json($data);
    }

    public function postUpdateEdit($id)
    {
        $user_ids = [];
        foreach(Input::get('user_ids') as $value)
        {
            $user_ids[] = "$value";
        }
        $id = Helper::simple_decrypt($id);
        $data = PasswordMgmt::find($id);
        $data->user_ids = json_encode($user_ids);

        $data->project_name = Helper::simple_encrypt(Input::get('project_name'));
        $data->live_f_url = Helper::simple_encrypt(Input::get('live_f_url'));
        $data->live_b_url = Helper::simple_encrypt(Input::get('live_b_url'));
        $data->live_b_username1 = Helper::simple_encrypt(Input::get('live_b_username1'));
        $data->live_b_password1 = Helper::simple_encrypt(Input::get('live_b_password1'));
        $data->live_b_username2 = Helper::simple_encrypt(Input::get('live_b_username2'));
        $data->live_b_password2 = Helper::simple_encrypt(Input::get('live_b_password2'));
        $data->live_b_username3 = Helper::simple_encrypt(Input::get('live_b_username3'));
        $data->live_b_password3 = Helper::simple_encrypt(Input::get('live_b_password3'));
        $data->live_c_url = Helper::simple_encrypt(Input::get('live_c_url'));
        $data->live_c_username = Helper::simple_encrypt(Input::get('live_c_username'));
        $data->live_c_password = Helper::simple_encrypt(Input::get('live_c_password'));
        $data->live_ftp_host = Helper::simple_encrypt(Input::get('live_ftp_host'));
        $data->live_ftp_port = Helper::simple_encrypt(Input::get('live_ftp_port'));
        $data->live_ftp_username = Helper::simple_encrypt(Input::get('live_ftp_username'));
        $data->live_ftp_password = Helper::simple_encrypt(Input::get('live_ftp_password'));
        $data->stagging_f_url = Helper::simple_encrypt(Input::get('stagging_f_url'));
        $data->stagging_b_url = Helper::simple_encrypt(Input::get('stagging_b_url'));
        $data->stagging_b_username1 = Helper::simple_encrypt(Input::get('stagging_b_username1'));
        $data->stagging_b_password1 = Helper::simple_encrypt(Input::get('stagging_b_password1'));
        $data->stagging_b_username2 = Helper::simple_encrypt(Input::get('stagging_b_username2'));
        $data->stagging_b_password2 = Helper::simple_encrypt(Input::get('stagging_b_password2'));
        $data->stagging_b_username3 = Helper::simple_encrypt(Input::get('stagging_b_username3'));
        $data->stagging_b_password3 = Helper::simple_encrypt(Input::get('stagging_b_password3'));
        $data->stagging_c_url = Helper::simple_encrypt(Input::get('stagging_c_url'));
        $data->stagging_c_username = Helper::simple_encrypt(Input::get('stagging_c_username'));
        $data->stagging_c_password = Helper::simple_encrypt(Input::get('stagging_c_password'));
        $data->stagging_ftp_host = Helper::simple_encrypt(Input::get('stagging_ftp_host'));
        $data->stagging_ftp_port = Helper::simple_encrypt(Input::get('stagging_ftp_port'));
        $data->stagging_ftp_username = Helper::simple_encrypt(Input::get('stagging_ftp_username'));
        $data->stagging_ftp_password = Helper::simple_encrypt(Input::get('stagging_ftp_password'));
        $data->ourserver_f_url = Helper::simple_encrypt(Input::get('ourserver_f_url'));
        $data->ourserver_b_url = Helper::simple_encrypt(Input::get('ourserver_b_url'));
        $data->ourserver_b_username1 = Helper::simple_encrypt(Input::get('ourserver_b_username1'));
        $data->ourserver_b_password1 = Helper::simple_encrypt(Input::get('ourserver_b_password1'));
        $data->ourserver_b_username2 = Helper::simple_encrypt(Input::get('ourserver_b_username2'));
        $data->ourserver_b_password2 = Helper::simple_encrypt(Input::get('ourserver_b_password2'));
        $data->ourserver_b_username3 = Helper::simple_encrypt(Input::get('ourserver_b_username3'));
        $data->ourserver_b_password3 = Helper::simple_encrypt(Input::get('ourserver_b_password3'));
        $data->ourserver_c_url = Helper::simple_encrypt(Input::get('ourserver_c_url'));
        $data->ourserver_c_username = Helper::simple_encrypt(Input::get('ourserver_c_username'));
        $data->ourserver_c_password = Helper::simple_encrypt(Input::get('ourserver_c_password'));
        $data->ourserver_ftp_host = Helper::simple_encrypt(Input::get('ourserver_ftp_host'));
        $data->ourserver_ftp_port = Helper::simple_encrypt(Input::get('ourserver_ftp_port'));
        $data->ourserver_ftp_username = Helper::simple_encrypt(Input::get('ourserver_ftp_username'));
        $data->ourserver_ftp_password = Helper::simple_encrypt(Input::get('ourserver_ftp_password'));

        $save = $data->save();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.update_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }


    public function getDestroyDelete($id)
    {
//        return Request::segment(2);
        $id = Helper::simple_decrypt($id);
        $country = PasswordMgmt::find($id);

        $save = $country->delete();
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.delete_record_msg'),
                'result' => null
            ]);
        } else {
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => null
            ]);
        }
    }
}