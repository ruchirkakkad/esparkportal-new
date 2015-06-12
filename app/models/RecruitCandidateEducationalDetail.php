<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class RecruitCandidateEducationalDetail extends \Eloquent {

	use SoftDeletingTrait;
	protected $fillable = [];

	protected $table = "recruit_candidate_educational_details";

	protected $primaryKey = "recruit_candidate_educational_details_id";
}