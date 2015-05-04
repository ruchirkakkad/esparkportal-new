<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EducationalQualification extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];

    protected $table = "educational_qualifications";

    protected $primaryKey = "educational_qualifications_id";
}