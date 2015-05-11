<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;
    use SoftDeletingTrait;


    protected $table = 'users';
    protected $primaryKey = 'user_id';


//	protected $hidden = array('password', 'remember_token');

    public function user_contact()
    {
        return $this->hasOne('UsersContact', 'user_id', 'user_id');
    }

    public function user_emergency()
    {
        return $this->hasOne('UsersEmergency', 'user_id', 'user_id');
    }

    public function user_personal()
    {
        return $this->hasOne('UsersPersonal', 'user_id', 'user_id');
    }

    public function user_work_experience()
    {
        return $this->hasMany('UsersWorkExperience', 'user_id', 'user_id');
    }

    public function users_qualification()
    {
        return $this->hasMany('UsersQualification', 'user_id', 'user_id');
    }

    public function user_bank_details()
    {
        return $this->hasOne('UsersBankDetail', 'user_id', 'user_id');
    }

    public function user_attachments()
    {
        return $this->hasMany('UsersAttachment', 'user_id', 'user_id');
    }

    public function department()
    {
        return $this->belongsTo('Department','department_id','departments_id');
    }

    public function designation()
    {
        return $this->belongsTo('Designation','designation_id','designations_id');
    }

    public function role()
    {
        return $this->belongsTo('Role','role_id','id');
    }



    public function job_profile()
    {
        return $this->belongsTo('JobProfile','job_profile','job_profiles_id');
    }
}
