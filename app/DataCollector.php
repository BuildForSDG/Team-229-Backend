<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DataCollector extends Eloquent implements JWTSubject
{
    protected $connection = 'mongodb';
    protected $collection = 'dataCollectors';
    protected $guarded = [];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
        ];
    }
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
