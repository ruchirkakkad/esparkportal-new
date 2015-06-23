<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Announcement extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "announcements";

    protected $primaryKey = "announcements_id";
}