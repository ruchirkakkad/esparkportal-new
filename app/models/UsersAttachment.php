<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class UsersAttachment extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];
    protected $table = 'users_attachments';
    protected $primaryKey  = 'users_attachments_id';
}