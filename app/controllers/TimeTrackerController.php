<?php

/**
 * Created by PhpStorm.
 * User: ruchir
 * Date: 5/18/2015
 * Time: 5:48 PM
 */
class TimeTrackerController extends \BaseController
{

    public function __construct()
    {

    }

    public function getUserWiseView()
    {
        return View::make('time_tracker.user_wise');
    }

    public function getUsersListView()
    {
        $data1 = User::where('role_id', '!=', 1)->get();

        $returndata = [];
        foreach ($data1 as $k => $v) {
            $id = Helper::simple_encrypt($v->user_id);
            $returndata[$k]['user_id'] = $v->user_id;
            $returndata[$k]['user_encryt_id'] = $id;
            $returndata[$k]['first_name'] = $v->first_name;
            $returndata[$k]['last_name'] = $v->last_name;
        }
        $data['users'] = $returndata;

        return $data;
    }
}
