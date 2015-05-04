<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Skill extends \Eloquent {

    use SoftDeletingTrait;
	protected $fillable = [];

    protected $table = "skills";

    protected $primaryKey = "skills_id";

}