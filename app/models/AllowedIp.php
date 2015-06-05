<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AllowedIp extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "allowed_ips";

    protected $primaryKey = "allowed_ips_id";

}