<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Currency;

class CurrenciesController extends Controller
{
    public function index () {
        $date = date('Y:m:d');
        return Currency::with(['exchanges' => function($q) use($date){
            $q->whereDate('date', $date);
        }])->get();
    }

    public function show ($date) {
        return Currency::with(['exchanges' => function($q) use($date){
            $q->whereDate('date', $date);
        }])->get();
    }
}
