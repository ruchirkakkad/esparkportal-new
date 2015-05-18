<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class WorkShift extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "work_shifts";

    protected $primaryKey = "work_shifts_id";

}