<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UsersPersonal extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [
        'user_id',
        'dob',
        'blood_group',
        'marital_status',
        'marital_status',
        'aniversary_date',
        'driving_licence_no',
        'passport_no',
        'skills',
        'languages',
        'bio'
    ];
    protected $table = 'users_personals';
    protected $primaryKey  = 'users_personals_id';
}