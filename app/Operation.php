<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Operation extends Model
{


    protected $appends = ['operation'];

    public function getOperationAttribute($value)
    {
        switch ($this->status) {
            case 0:
                return "Пополнение баланса";
                break;
            case 1:
                return "Перевод баланса";
                break;
            case 2:
                return "Получение баланса";
                break;
        }
    }

    protected $fillable = [
        'user_id', 'recipient_id', 'summ', 'status', 'conversion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'recipient_id', 'id');
    }

    public function user_recipient()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
