<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use \Awobaz\Compoships\Compoships;

    public function exchanges()
    {
        return $this->hasOne('App\Exchange', 'currency_id', 'id');
    }
}
