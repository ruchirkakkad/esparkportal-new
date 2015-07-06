<?php

class RecruitCandidatesController extends \BaseController
{


    public function getCreateAdd()
    {
        return View::make('recruit_candidates.create');
    }

    public function getCreatedataAdd()
    {
        $data['educational_qualifications'] = EducationalQualification::all();
        $data['designations'] = Designation::all();
        $data['skills'] = Skill::all();
        return $data;
    }

    public function postStoreAdd()
    {
        $recruit_candidate = new RecruitCandidate();
        $recruit_candidate->recruit_candidates_fname = Input::get('recruit_candidates_fname');
        $recruit_candidate->recruit_candidates_mname = Input::get('recruit_candidates_mname');
        $recruit_candidate->recruit_candidates_lname = Input::get('recruit_candidates_lname');
        $recruit_candidate->recruit_candidates_address = Input::get('recruit_candidates_address');
        $recruit_candidate->recruit_candidates_email = Input::get('recruit_candidates_email');
        $recruit_candidate->recruit_candidates_contact_no = Input::get('recruit_candidates_contact_no');
        $recruit_candidate->recruit_candidates_apply_for = Input::get('recruit_candidates_apply_for');
        $recruit_candidate->recruit_candidates_skills = json_encode(Input::get('recruit_candidates_skills'));
        $recruit_candidate->recruit_candidates_category = Input::get('recruit_candidates_category');

        $save = $recruit_candidate->save();
        $users_qualification = Input::get('users_qualification');
        foreach ($users_qualification as $val) {
            if ($val['educational_qualifications_id'] != '') {
                $data = new RecruitCandidateEducationalDetail();
                $data->recruit_candidate_id = $save->recruit_candidates_id;
                $data->educational_qualifications_id = $val['educational_qualifications_id'];
                $data->university = $val['university'];
                $data->passing_year = $val['passing_year'];
                $data->grade = $val['grade'];
                $data->save();
            }
        }
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

    public function postStoreResumeAdd()
    {
        $recruit_candidate = new RecruitCandidate();
        $recruit_candidate->recruit_candidates_fname = Input::get('recruit_candidates_fname');
        $recruit_candidate->recruit_candidates_mname = Input::get('recruit_candidates_mname');
        $recruit_candidate->recruit_candidates_lname = Input::get('recruit_candidates_lname');
        $recruit_candidate->recruit_candidates_address = Input::get('recruit_candidates_address');
        $recruit_candidate->recruit_candidates_email = Input::get('recruit_candidates_email');
        $recruit_candidate->recruit_candidates_contact_no = Input::get('recruit_candidates_contact_no');
        $recruit_candidate->recruit_candidates_apply_for = Input::get('recruit_candidates_apply_for');
        $recruit_candidate->recruit_candidates_skills = json_encode(Input::get('recruit_candidates_skills'));
        $recruit_candidate->recruit_candidates_category = Input::get('recruit_candidates_category');

        if (Input::hasFile('resume')) {
            $file = Input::file('resume');

            $destinationPath = public_path() . '/uploads/candidates_resumes/';

//            $filename = 'profile_image.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
        } else {
            $uploadSuccess = "";
        }

        if ($uploadSuccess) {
            $recruit_candidate->recruit_candidates_resume = "/uploads/candidates_resumes/" . $filename;
        }

        $users_qualification = json_decode(Input::get('users_qualification'), true);
        $save = $recruit_candidate->save();

        foreach ($users_qualification as $val) {
            if ($val['educational_qualifications_id'] != '') {
                $data = new RecruitCandidateEducationalDetail();
                $data->recruit_candidate_id = $recruit_candidate->recruit_candidates_id;
                $data->educational_qualifications_id = $val['educational_qualifications_id'];
                $data->university = $val['education_university'];
                $data->passing_year = $val['passing_year'];
                $data->grade = $val['grade'];
                $data->save();
            }
        }
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

    public function getIndexView()
    {
        return View::make('recruit_candidates.index');
    }

    public function getIndexDataView()
    {
        $data1 = RecruitCandidate::with('designation')->get();
        $data['aaData'] = $data1;
        $returndata = json_decode(json_encode($data), true);
        foreach ($returndata as $key => $val) {
            foreach ($val as $key1 => $val1) {
                $id = Helper::simple_encrypt($val1['recruit_candidates_id']);
                $returndata[$key][$key1]['edit'] = $id;
                $returndata[$key][$key1]['delete'] = $id;
            }
        }
        return $returndata;
    }

    public function postChangeStatusToScheduledView()
    {
        $settings = Setting::all();
        $settings_data = [];
        foreach($settings as $key => $val)
        {
            $settings_data[$val->key] = $val->value;
        }
        $settings_data = json_decode(json_encode($settings_data));
        $request_data = Input::get('candidate');
        $id = $request_data['recruit_candidates_id'];
        $candidate_action = new RecruitCandidateAction();
        $candidate_action->recruit_candidate_id = $id;
        $candidate_action->date = date('Y-m-d',strtotime($request_data['date']));
        $candidate_action->time = date('H:i:s',strtotime($request_data['time']));
        $candidate_action->action = $request_data['recruit_candidates_action'];
        $candidate_action->subject = $request_data['subject'];
        $candidate_action->save();
        $candidate = RecruitCandidate::find($id);
        $candidate->recruit_candidates_action = 'Reschedule';
        $save = $candidate->save();
        $count = RecruitCandidateAction::where('recruit_candidate_id', '=', $id)->count();
        $data = [
            'candidate' => $candidate,
            'candidate_action' => $candidate_action,
            'settings' => $settings_data,
            'request_data' => $request_data,
        ];
        Mail::send('emails/schedule_interview', $data, function ($message) use ($candidate,$candidate_action,$settings_data) {
            $message->to($candidate->recruit_candidates_email, $candidate->recruit_candidates_fname)->subject('eSparkBiz has scheduled your interview on Date:- '.date('M d, Y (l)',strtotime($candidate_action->date)).'and Time:- '.date('H:i A',strtotime($candidate_action->time)));
        });
        Mail::send('emails/schedule_interview', $data, function ($message) use ($candidate,$candidate_action,$settings_data) {
            $message->to($settings_data->hr_email, $settings_data->hr_name)->subject('eSparkBiz has scheduled an interview ');
        });
        if ($save) {
            return json_encode([
                'code' => 200,
                'msg' => Config::get('constants.store_record_msg'),
                'result' => ['candidate' => $candidate, 'action_count' => $count]
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