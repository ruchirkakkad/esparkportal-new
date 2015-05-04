<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Designation extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "designations";

    protected $primaryKey = "designations_id";

    public function job_profiles()
    {
        return $this->hasMany('JobProfile', 'designations_id', 'designations_id');
    }

}