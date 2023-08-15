<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Financial;
use App\Models\PersonalFinance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BotApiController extends Controller
{
    public function getBalance()
    {
        $data['total_income'] = Financial::where('financial_type', 'income')->sum('financial_amount');
        $data['total_expense'] = Financial::where('financial_type', 'expense')->sum('financial_amount');
        $data['total_balance'] = $data['total_income'] - $data['total_expense'];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 201);
    }

    /**
     * Store Personal Finance
     */
    public function storePersonalFinance(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'amount' => 'required',
            'type' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'amount.required' => 'Jumlah tidak boleh kosong',
            'type.required' => 'Tipe tidak boleh kosong'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()->all()
            ], 400);
        }

        $financial = new PersonalFinance();
        $financial->name = $request->name;
        $financial->amount = $request->amount;
        $financial->type = $request->type;
        $financial->date = date('Y-m-d');
        $financial->month = date('m');
        $financial->year = date('Y');
        $financial->save();

        if($request->type == 'income'){
            $type = 'Pemasukan';
        } elseif($request->type == 'expense'){
            $type = 'Pengeluaran';
        }
        $message = $type.' - '.$request->name.' sebesar '.'Rp. '.
                    number_format($request->amount, 0, ',', '.').' telah ditambahkan.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], 201);
    }

    public function getAllPersonalFinance()
    {
        $data['total_income'] = 'Rp. '.
                                number_format(PersonalFinance::where('type', 'income')->sum('amount'), 0, ',', '.');
        $data['total_expense'] = 'Rp. '.
                                number_format(PersonalFinance::where('type', 'expense')->sum('amount'), 0, ',', '.');

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 201);
    }
}
