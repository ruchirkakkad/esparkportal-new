<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UsersBankDetail extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [
        'bank_name',
        'branch_name',
        'account_no',
        'account_type',
        'ifsc_no'
    ];
    protected $table = 'users_bank_details';
    protected $primaryKey  = 'users_bank_details_id';
}