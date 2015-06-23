<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Holiday extends \Eloquent {

    use SoftDeletingTrait;
    protected $fillable = [];

    protected $table = "holidays";

    protected $primaryKey = "holidays_id";
}