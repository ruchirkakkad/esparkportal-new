<?php

class UserIpPermissionController extends \BaseController
{


    public function getIndexView()
    {
        return View::make('user_ip_permission.index');
    }

    public function postIndexdataView()
    {
        $data1 = User::where("role_id", "!=", 1)->get();
        $data1 = User::all();
        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->user_id);
            $returndata[$k]["user_id"] = $v->user_id;
            $returndata[$k]["profile_image"] = $v->profile_image;
            $returndata[$k]["user_encryt_id"] = $id;
            $returndata[$k]["first_name"] = $v->first_name;
            $returndata[$k]["last_name"] = $v->last_name;
            $returndata[$k]["ip_access_expire_time"] = $v->ip_access_expire_time;
            if (date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($v->ip_access_expire_time))) {
                $returndata[$k]["is_expired"] = 1;
            } else {
                $returndata[$k]["is_expired"] = 0;
            }
        }
        $data["users"] = $returndata;
        return $data;
    }


    public function getUserExpirationView()
    {
        return View::make('user_ip_permission.users_permission');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data = User::find($id);
        if ($data->ip_access_expire_time == '0000-00-00 00:00:00') {
            $data->ip_access_expire_time = '';
        }
        return $data;

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $data = User::find($id);
        $data->ip_access_expire_time = date('Y-m-d H:i:s',strtotime(Input::get('ip_access_expire_time')));

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
}