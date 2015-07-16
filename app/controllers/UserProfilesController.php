<?php

class UserProfilesController extends \BaseController
{

    public function getIndexView()
    {
        return View::make('user_profiles.index');
    }

    public function postIndexdataView()
    {
        $user_id = Auth::user()->user_id;
        $data['user'] = User::where('user_id', '=', $user_id)->with([
            'user_contact',
            'user_emergency',
            'user_personal',
            'user_work_experience',
            'users_qualification',
            'user_bank_details',
            'department',
            'designation',
            'role',
            'job_profile',
            'user_attachments'])->get();


        if (isset($data['user'][0]->user_personal['skills'])) {
            $data['user'][0]->user_personal['skills'] = Skill::select('skills_name', 'skills_id')->whereIn('skills_id', json_decode($data['user'][0]->user_personal['skills']))->get();
        }

        if (isset($data['user'][0]->user_personal['languages'])) {
            $data['user'][0]->user_personal['languages'] = Language::select('languages_name', 'languages_id')->whereIn('languages_id', json_decode($data['user'][0]->user_personal['languages']))->get();
        }

//        $data['skills'] = Skill::select('skills_name', 'skills_id')->get();
//        $data['languages'] = Language::select('languages_name', 'languages_id')->get();
        $data['educational_qualifications'] = EducationalQualification::lists('educational_qualifications_name', 'educational_qualifications_id');
        return $data;
    }

    public function getEditEdit()
    {
        return View::make('user_profiles.edit');
    }

    public function postFindEdit()
    {
        $user_id = Auth::user()->user_id;
        $data['user'] = User::where('user_id', '=', $user_id)->with([
            'user_contact',
            'user_emergency',
            'user_personal',
            'user_work_experience',
            'users_qualification',
            'user_bank_details',
            'department',
            'designation',
            'role',
            'job_profile',
            'user_attachments'])->get();


        if (isset($data['user'][0]->user_personal['skills'])) {
            $data['user'][0]->user_personal['skills'] = Skill::select('skills_name', 'skills_id')->whereIn('skills_id', json_decode($data['user'][0]->user_personal['skills']))->get();
        }

        if (isset($data['user'][0]->user_personal['languages'])) {
            $data['user'][0]->user_personal['languages'] = Language::select('languages_name', 'languages_id')->whereIn('languages_id', json_decode($data['user'][0]->user_personal['languages']))->get();
        }

        $data['skills'] = Skill::select('skills_name', 'skills_id')->get();
        $data['languages'] = Language::select('languages_name', 'languages_id')->get();
        $data['educational_qualifications'] = EducationalQualification::select('educational_qualifications_name', 'educational_qualifications_id')->get();
        return $data;
    }

    public function postUpdateGeneralDetailsEdit()
    {
        $user_id = Auth::user()->user_id;
        $user_personal = UsersPersonal::firstOrCreate(['user_id' => $user_id]);

        $user_personal->user_id = $user_id;
        $user_personal->dob = date('Y-m-d', strtotime(Input::get('dob')));
        $user_personal->blood_group = Input::get('blood_group');
        $user_personal->marital_status = Input::get('marital_status');
        $user_personal->spouse_name = Input::get('spouse_name');
        $user_personal->aniversary_date = date('Y-m-d', strtotime(Input::get('aniversary_date')));
        $user_personal->driving_licence_no = Input::get('driving_licence_no');
        $user_personal->passport_no = Input::get('passport_no');
        $user_personal->skills = json_encode(Input::get('skills'));
        $user_personal->languages = json_encode(Input::get('languages'));
        $user_personal->bio = Input::get('bio');

        $save = $user_personal->save();
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

    public function postUpdateContactDetailsEdit()
    {
        $user_id = Auth::user()->user_id;
        $user_contact = UsersContact::firstOrCreate(['user_id' => $user_id]);

        $user_contact->user_id = $user_id;

        $user_contact->current_address = Input::get('current_address');
        $user_contact->current_city = Input::get('current_city');
        $user_contact->current_state = Input::get('current_state');
        $user_contact->current_zipcode = Input::get('current_zipcode');
        $user_contact->current_phone = Input::get('current_phone');
        $user_contact->current_skype = Input::get('current_skype');
        $user_contact->permanent_address = Input::get('permanent_address');
        $user_contact->permanent_city = Input::get('permanent_city');
        $user_contact->permanent_state = Input::get('permanent_state');
        $user_contact->permanent_zipcode = Input::get('permanent_zipcode');
        $user_contact->permanent_phone = Input::get('permanent_phone');
        $user_contact->permanent_skype = Input::get('permanent_skype');

        $save = $user_contact->save();
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

    public function postUpdateEmergencyDetailsEdit()
    {
        $user_id = Auth::user()->user_id;
        $user_emergency = UsersEmergency::firstOrCreate(['user_id' => $user_id]);

        $user_emergency->user_id = $user_id;

        $user_emergency->contact_name = Input::get('contact_name');
        $user_emergency->contact_relation = Input::get('contact_relation');
        $user_emergency->contact_phone = Input::get('contact_phone');
        $user_emergency->contact_address = Input::get('contact_address');


        $save = $user_emergency->save();
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

    public function postUpdateBankDetailsEdit()
    {
        $user_id = Auth::user()->user_id;
        $user_bank_details = UsersBankDetail::firstOrCreate(['user_id' => $user_id]);

        $user_bank_details->user_id = $user_id;

        $user_bank_details->bank_name = Input::get('bank_name');
        $user_bank_details->branch_name = Input::get('branch_name');
        $user_bank_details->account_no = Input::get('account_no');
        $user_bank_details->account_type = Input::get('account_type');
        $user_bank_details->ifsc_no = Input::get('ifsc_no');

        $save = $user_bank_details->save();
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

    public function postUpdateWorkexperienceEdit()
    {
        $user_id = Auth::user()->user_id;

        $work_experiences = Input::get('work_experiences');


        UsersWorkExperience::where('user_id', '=', $user_id)->delete();

        foreach ($work_experiences as $key => $val) {
            $work_experience = new UsersWorkExperience;
            $work_experience->user_id = $user_id;
            $work_experience->job_duration_start = date('Y-m-d', strtotime($val['job_duration_start']));
            $work_experience->job_duration_end = date('Y-m-d', strtotime($val['job_duration_end']));
            $work_experience->company_name = $val['company_name'];
            $work_experience->company_number = $val['company_number'];
            $work_experience->company_address = $val['company_address'];
            $work_experience->save();
        }

        return json_encode([
            'code' => 200,
            'msg' => Config::get('constants.update_record_msg'),
            'result' => null
        ]);

    }

    public function postUpdateQualificationDetailsEdit()
    {
        $user_id = Auth::user()->user_id;

        $users_qualification = Input::get('users_qualification');


        UsersQualification::where('user_id', '=', $user_id)->delete();

        foreach ($users_qualification as $key => $val) {
            $data = new UsersQualification();
            $data->user_id = $user_id;

            $data->educational_qualifications_id = $val['educational_qualifications_id'];
            $data->degree = $val['degree'];
            $data->education_university = $val['education_university'];
            $data->passing_year = $val['passing_year'];
            $data->grade = $val['grade'];
            $data->save();
        }

        return json_encode([
            'code' => 200,
            'msg' => Config::get('constants.update_record_msg'),
            'result' => null
        ]);

    }


    public function postUpdateEdit()
    {
        $userData = Input::get('user');

        $user_id = Auth::user()->user_id;
        $data = User::find($user_id);
        $data->first_name = $userData['first_name'];
        $data->middle_name = $userData['middle_name'];
        $data->last_name = $userData['last_name'];
        $data->personal_email = $userData['personal_email'];
        $data->gender = $userData['gender'];

        if($userData['password'] != '')
        {
            $data->password = Hash::make($userData['password']);
        }

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

    public function postUpdateWithProfilepicEdit()
    {
        $userData = json_decode(Input::get('user'));
        $profile_pic = Input::file('profile_pic');

        $user_id = Auth::user()->user_id;
        $data = User::find($user_id);


        $rules = array(
            'profile_pic' => 'required | image | max:300000|mimes:jpg,jpeg,bmp,png',
        );
        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make(['profile_pic' => $profile_pic], $rules);
        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return json_encode([
                'code' => 403,
                'msg' => Config::get('constants.error_record_msg'),
                'result' => $messages
            ]);
        } else {
            // validation successful ---------------------------

            $destinationPath = '';
            $filename = '';

            if (Input::hasFile('profile_pic')) {
                $file = Input::file('profile_pic');

                $destinationPath = public_path() . '/uploads/' . $userData->email;

                $filename = 'profile_image.' . $file->getClientOriginalExtension();
//                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
            } else {
                $uploadSuccess = "";
            }

            if ($uploadSuccess) {
                $data->profile_image = "uploads/" . $userData->email . "/" . $filename;
            }

            $data->first_name = $userData->first_name;
            $data->middle_name = $userData->middle_name;
            $data->last_name = $userData->last_name;
            $data->personal_email = $userData->personal_email;
            $data->gender = $userData->gender;

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


    public function postUpdateAttachmentsEdit()
    {
        $name = $_REQUEST['attachment_name'];

        $attachment = Input::file('attachment');

        $user_id = Auth::user()->user_id;

        $data = new UsersAttachment();


        $destinationPath = '';
        $filename = '';

        $email = Auth::user()->email;
        if (Input::hasFile('attachment')) {
            $file = Input::file('attachment');

            $destinationPath = public_path() . '/uploads/' . $email.'/attachments/';

//            $filename = 'profile_image.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
        } else {
            $uploadSuccess = "";
        }

        if ($uploadSuccess) {
            $data->attachment_url = "uploads/" . $email .'/attachments/'. $filename;
        }


        $data->user_id = $user_id;
        $data->attachment_name = $name;
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

    public function getDownloadAttachmentView($file = null)
    {
        $file = 'uploads/admin@admin.com/attachments/Lighthouse.jpg';

        $name= $_GET['attachement'];

        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($name));
        ob_clean();
        flush();
        readfile("your_file_path/".$name); //showing the path to the server where the file is to be download
        exit;
    }

}