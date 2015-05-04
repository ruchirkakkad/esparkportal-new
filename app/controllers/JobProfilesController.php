<?php

class JobProfilesController extends \BaseController {

    public function getIndexView()
    {
        return View::make('job_profiles.index');
    }

    public function getIndexdataView()
    {
        $data1 = JobProfile::has('designation')->get();
        
        $returndata = [];
        foreach($data1 as $k => $v)
        {
            $id = Helper::simple_encrypt($v->job_profiles_id);
            $returndata[$k]['job_profiles_id'] = $v->job_profiles_id;
            $returndata[$k]['job_profiles_name'] = $v->job_profiles_name;
            $returndata[$k]['designations_name'] = $v->designation->designations_name;
            $returndata[$k]['edit'] = $id;
            $returndata[$k]['delete'] = $id;
        }

        $data['aaData'] = $returndata;

        return $data;
    }

    public function getCreateAdd()
    {
        return View::make('job_profiles.create');
    }

    public function postDesignationsAdd()
    {
        $data['designations'] = Designation::select('designations_name', 'designations_id')->get();
        return json_encode($data);
    }

    public function postStoreAdd()
    {
        $job_profiles = new JobProfile();
        $job_profiles->job_profiles_name = Input::get('job_profiles_name');
        $job_profiles->designations_id = Input::get('designations_id');

        $save = $job_profiles->save();
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

    public function show($id)
    {
        //
    }

    public function getEditEdit()
    {
        return View::make('job_profiles.edit');
    }

    public function postFindEdit($id)
    {
        $id = Helper::simple_decrypt($id);

        $data['job_profiles'] = JobProfile::find($id);

        $data['job_profiles']->job_profiles_id = Helper::simple_encrypt($data['job_profiles']->job_profiles_id);
        $data['designations'] = Designation::select('designations_name', 'designations_id')->get();
        return Response::json($data);

    }

    public function postUpdateEdit($id)
    {
        $id = Helper::simple_decrypt($id);
        $job_profiles = JobProfile::find($id);
        $job_profiles->job_profiles_name = Input::get('job_profiles_name');
        $job_profiles->designations_id = Input::get('designations_id');
        $save = $job_profiles->save();
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
        $job_profiles = JobProfile::find($id);

        $save = $job_profiles->delete();
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
