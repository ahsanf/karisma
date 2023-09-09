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

    public function getPersonalFinance(Request $request)
    {
        $year = $request->year ?? date('Y');
        $month = $request->month ?? '';
        $search = $request->search ?? '';
        // dd($search);
        $finance = PersonalFinance::filter([
                            'year' => $year,
                            'month' => $month,
                            'search' => $search
                    ])->get();
        $data['total_income'] = 'Rp. '.
                                number_format($finance->where('type', 'income')->sum('amount'), 0, ',', '.');

        $data['total_expense'] = 'Rp. '.
                                number_format($finance->where('type', 'expense')->sum('amount'), 0, ',', '.');

        $monthName = $this->getIndonesianMonthName($month);

        if(!empty($search)){
            $data['message'] = 'Laporan Keuangan '.$monthName.' '.$year.' dengan kata kunci '.$search;
        } elseif($month == ''){
            $data['message'] = 'Laporan Keuangan '.$year;
        }
        return response()->json([
            'status' => 'success',
            'data' => $data
    ], 201);
    }

    public function getRecapFinanceByYear(Request $request)
    {
        $year = $request->year ?? date('Y');
        $finances = PersonalFinance::filter(['year' => $year])
        ->select('name', 'amount', 'month', 'year', 'type')
        ->orderBy('month', 'asc')
        ->get()->toArray();

        $filter['income'] = array_values(array_filter($finances, [$this, 'splitIncome']));
        $filter['expense'] = array_values(array_filter($finances, [$this, 'splitExpense']));

        foreach($this->groupBy($filter['expense'], 'month') as $key => $expenses){
            foreach($expenses as $expense){
                $data[$key]['expense'] = array_sum(array_column($expenses, 'amount'));
                $data[$key]['month'] = $expense['month'];
            }
        }

        foreach($this->groupBy($filter['income'], 'month') as $key => $incomes){
            foreach($incomes as $income){
                $data[$key]['income'] = array_sum(array_column($incomes, 'amount'));
                $data[$key]['month'] = $income['month'];
            }
        }


        $rawDatas = array_values($data);
        $result = [];

        foreach($rawDatas as $rawData){
            if(!isset($rawData['income'])){
                $rawData['income'] = 0;
            }
            $temp['income'] = 'Rp. '.
                                number_format($rawData['income'] , 0, ',', '.');
            $temp['expense'] = 'Rp. '.
                                number_format($rawData['expense'] , 0, ',', '.');
            $temp['month_name'] = $this->getIndonesianMonthName($rawData['month']);

            array_push($result, $temp);

        }

        return response()->json([
            'status' => 'success',
            'message' => 'Rekap Laporan Keuangan Tahun '.$year,
            'data' => $result
        ], 200);

    }

    private function groupBy($array, $key) {
        $return = array();
        foreach($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }

    private function splitIncome($var){
        return $var['type'] == 'income';
    }

    private function splitExpense($var){
        return $var['type'] == 'expense';
    }

    private function getIndonesianMonthName($month)
    {
        $monthName = '';
        switch ($month) {
            case '01':
                $monthName = 'Januari';
                break;
            case '02':
                $monthName = 'Februari';
                break;
            case '03':
                $monthName = 'Maret';
                break;
            case '04':
                $monthName = 'April';
                break;
            case '05':
                $monthName = 'Mei';
                break;
            case '06':
                $monthName = 'Juni';
                break;
            case '07':
                $monthName = 'Juli';
                break;
            case '08':
                $monthName = 'Agustus';
                break;
            case '09':
                $monthName = 'September';
                break;
            case '10':
                $monthName = 'Oktober';
                break;
            case '11':
                $monthName = 'November';
                break;
            case '12':
                $monthName = 'Desember';
                break;
            default:
                $monthName = 'Tahun';
                break;
        }

        return $monthName;
    }
}
