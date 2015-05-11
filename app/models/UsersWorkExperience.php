<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UsersWorkExperience extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];
    protected $table = 'users_work_experiences';
    protected $primaryKey  = 'users_work_experiences_id';
}