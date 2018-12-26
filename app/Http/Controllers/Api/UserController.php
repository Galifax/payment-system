<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use DB;

class UserController extends Controller
{
    public function show ($name, Request $request) {
        $model = $this->report($name, $request);
        if ($request->export) {
            return Excel::download(new UserExport($model), 'report.xlsx');
        }
        return $model;
    }

    public function report ($name, $request) {
        $model = User::
        withCount(['operations as balance' => function ($q) use($request){ 
            $q->select(DB::raw("SUM(conversion)"))->where('status', 0);
            if ($request->date_from) {
                $q->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $q->whereDate('created_at', '<=', $request->date_to);
            }
        }])
        ->withCount(['operations as forwarded' => function ($q) use($request){ 
            $q->select(DB::raw("SUM(conversion)"))->where('status', 1);
            if ($request->date_from) {
                $q->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $q->whereDate('created_at', '<=', $request->date_to);
            }
        }])
        ->withCount(['forwards as received' => function ($q) use($request){ 
            $q->select(DB::raw("SUM(conversion)"));
            if ($request->date_from) {
                $q->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $q->whereDate('created_at', '<=', $request->date_to);
            }
        }])
        ->with(['currency', 'forwards.user_recipient.currency', 'operations' => function($q) use($request){
            if ($request->date_from) {
                $q->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $q->whereDate('created_at', '<=', $request->date_to);
            }
            $q->with('user.currency');
        }])
        ->where('name', $name)
        ->orWhere('id', $name)
        ->firstOrFail();

        $model->operations->merge($model->forwards);
        return $model;
    }
}
