<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class JobProfile extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "job_profiles";

    protected $primaryKey = "job_profiles_id";

    public function designation()
    {
        return $this->belongsTo('Designation', 'designations_id', 'designations_id');
    }

}