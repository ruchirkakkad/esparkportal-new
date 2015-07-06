<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class RecruitCandidate extends \Eloquent {

	use SoftDeletingTrait;
	protected $fillable = [];

	protected $table = "recruit_candidates";

	protected $primaryKey = "recruit_candidates_id";

    public function designation()
    {
        return $this->belongsTo('Designation','recruit_candidates_apply_for','designations_id');
    }
}