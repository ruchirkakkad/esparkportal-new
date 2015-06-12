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
            $recruit_candidate->recruit_candidates_resume = "/uploads/candidates_resumes/". $filename;
        }

        $users_qualification = json_decode(Input::get('users_qualification'),true);
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
}