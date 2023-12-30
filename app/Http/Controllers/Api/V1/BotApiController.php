<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
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
        $years = $request->year ?? date('Y');
        $months = $request->month ?? [1,2,3,4,5,6,7,8,9,10,11,12];
        $search = $request->search ?? '';
        $monthNames = [];
        $yearsNames = [];

        if(!is_array($months)){
            $months = explode(',', $months);
        }

        if(!is_array($years)){
            $years = explode(',', $years);
        }

        $finance  = PersonalFinance::whereIn('month', $months)
                    ->whereIn('year', $years)
                    ->where('name','LIKE','%'.$search.'%')
                    ->get();

        $data['total_income'] = 'Rp. '.
                                number_format($finance->where('type', 'income')->sum('amount'), 0, ',', '.');

        $data['total_expense'] = 'Rp. '.
                                number_format($finance->where('type', 'expense')->sum('amount'), 0, ',', '.');

        foreach($months as $month){
            $monthName = $this->getIndonesianMonthName($month);
            array_push($monthNames, $monthName);
        }

        foreach($years as $year){
            array_push($yearsNames, $year);
        }

        if(!empty($search)){
            $data['message'] = 'Laporan Keuangan '.
                                implode(', ', $monthNames).' '.
                                implode(', ', $yearsNames).' dengan kata kunci '.$search;
        } else {
            $data['message'] = 'Laporan Keuangan '.
                                implode(', ', $monthNames).' '.
                                implode(', ', $yearsNames);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
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

    public function getEvents(){
        $finalResult = [];
        $data['events'] = Event::select( 'id', 'event_name', 'event_start', 'event_place', 'event_day', 'event_end', 'event_date', 'event_place')
                        ->orderBy('event_date', 'desc')
                        ->withCount('members')
                        ->get()
                        ->toArray();

        foreach($data['events'] as $event) {
            $event['date_string'] = DateHelper::getDateString($event['event_date']);
            $event['format_start'] = DateHelper::formatTime($event['event_start']);
            $event['format_end'] = DateHelper::formatTime($event['event_end']);
            array_push($finalResult, $event);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar Acara',
            'data' => $finalResult
        ], 200);
    }

    public function getEventMembers(Request $request) {
        $eventId = $request->eventId;

        $event = Event::findOrFail($eventId)
                ->load('members')
                ->toArray();
        $event['final_members'] = [];

        foreach($event['members'] as $member) {
            $imagePath = url('/').DIRECTORY_SEPARATOR.'uploads'.$member['pivot']['image_path'];
            $member['pivot']['image_path'] = $imagePath;
            array_push($event['final_members'], $member);
        }
        $event['event_date'] = DateHelper::getDateString($event['event_date']);
        $event['event_start'] = DateHelper::formatTime($event['event_start']);
        $event['event_end'] = DateHelper::formatTime($event['event_end']);
        
        unset($event['members']);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Acara',
            'data' => $event
        ], 200);
    }
}
