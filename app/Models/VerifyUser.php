<?php

class VerifyUser extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
