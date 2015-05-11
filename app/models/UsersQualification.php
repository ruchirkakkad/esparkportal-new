<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UsersQualification extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];
    protected $table = 'users_qualifications';
    protected $primaryKey  = 'users_qualifications_id';

    public function educational_qualification()
    {
        return $this->belongsTo('EducationalQualification','educational_qualifications_id','educational_qualifications_id');
    }
}