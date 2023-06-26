<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Financial;
use Illuminate\Http\Request;

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
        ], 200);
    }
}
