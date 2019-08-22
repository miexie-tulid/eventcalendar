<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'from_date', 'to_date', 'selected_days','colour'];
}
