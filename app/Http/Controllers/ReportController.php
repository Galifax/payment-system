<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ReportController extends Controller
{
    public function index() {
        $model = User::all();
        return view('reports.index', compact('model'));
    }
}
