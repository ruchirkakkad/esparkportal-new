<?php

class Leave extends \Eloquent {
    protected $fillable = [];

    protected $table = "leaves";

    protected $primaryKey = "leaves_id";

    public function leave_type()
    {
        return $this->belongsTo('LeaveType','leave_types_id','leave_types_id');
    }

    public function user()
    {
        return $this->belongsTo('User','users_id','user_id');
    }
}