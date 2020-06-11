<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Participant extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'participants';
    protected $guarded = [];
}
