<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NacinStudija extends Model
{
    protected $table = 'nacin_studija';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
