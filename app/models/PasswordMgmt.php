<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PasswordMgmt extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "password_mgmts";

    protected $primaryKey = "password_mgmts_id";

}