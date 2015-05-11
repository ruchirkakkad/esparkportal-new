<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UsersEmergency extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = ['user_id','contact_name','contact_relation','contact_phone','contact_address'];
    protected $table = 'users_emergencies';
    protected $primaryKey  = 'users_emergencies_id';
}