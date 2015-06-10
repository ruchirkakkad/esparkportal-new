<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class LeaveType extends \Eloquent {
    use SoftDeletingTrait;

    protected $fillable = [];

    protected $table = "leave_types";

    protected $primaryKey = "leave_types_id";

    public function leaves()
    {
        return $this->hasMany('Leave','leaves_id');
    }
}