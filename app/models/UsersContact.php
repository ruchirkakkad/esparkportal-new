<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UsersContact extends \Eloquent {

    use SoftDeletingTrait;

	protected $fillable = ['user_id','current_address','current_city','current_state','current_zipcode','current_phone','current_skype','permanent_address','permanent_city','permanent_state','permanent_zipcode','permanent_phone','permanent_skype'];
    protected $table = 'users_contacts';
    protected $primaryKey  = 'users_contacts_id';
}