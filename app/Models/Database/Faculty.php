<?php

namespace app\Models\Database;


use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'id', 'name', 'code', 'community_id', 'university_id',
    ];

    public function community()
    {
        return $this->belongsTo('app\Models\Database\Community', 'community_id');
    }

    public function university()
    {
        return $this->belongsTo('app\Models\Database\University', 'university_id');
    }
}