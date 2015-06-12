<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class RecruitCandidate extends \Eloquent {

	use SoftDeletingTrait;
	protected $fillable = [];

	protected $table = "recruit_candidates";

	protected $primaryKey = "recruit_candidates_id";
}