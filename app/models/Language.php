<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Language extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "languages";

    protected $primaryKey = "languages_id";


}