<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Operation;
use App\User;
use DB;

class ProfileController extends Controller
{
    public function upBalance(Request $request) {
        if ($request->summ > 0) {
            $input = $request->all();
            $input['status'] = 0;
            $model = Operation::create($input);
            $user = User::find($request->user_id);
            $user->money += $request->summ;
            $user->save();
            return $user;
        } else {
            abort(500, 'Сума должна быть больше 0');
        }
    }

    public function transfer(Request $request) {
        $model = null;
        if ($request->user_id == $request->recipient_id) return abort(500, 'Вы неможете переслать самому себе деньги');
        if ($request->summ < 1) return abort(500, 'Сума должна быть больше 0');

        DB::transaction(function() use($request, &$model){

            $input = $request->all();
            $user = User::with('currency')->find($request->user_id);
            
            $recipient = User::with('currency')->find($request->recipient_id);
            if (isset($recipient)) {
                if ($user->money >= $request->summ) {
                    $user->money -= round($request->summ, 2);
                    $user->save();
                    if ($request->currency_id != $recipient->currency_id) {
                        $summ = ($request->summ / $user->currency->exchange) * $recipient->currency->exchange;
                        $input['conversion'] = round($summ, 2);
                    } else {
                        $summ = $request->summ;
                    }
                    $input['status'] = 1;
                    $model = Operation::create($input);
                    $recipient->money += round($summ, 2);
                    $recipient->save();
            
                    $model->load('user.currency');
                } else {
                    return abort(500, 'Не достаточно средств');
                }
            } else {
                return abort(500, 'Пользователь на найден');
            }
        });

        return $model;

       
    }
}
