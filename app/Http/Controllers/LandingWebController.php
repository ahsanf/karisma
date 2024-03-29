<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Models\Documentation;
use App\Models\Event;
use App\Models\Financial;
use App\Models\FinancialCategory;
use App\Models\Member;
use Illuminate\Http\Request;

class LandingWebController extends Controller
{
    public function index(){
        $event = [];
        $data['page_title']  = 'Beranda';
        $data['action'] = ['table_datatable_basic', 'uc_select2', 'form_pickers'];
        $data['event_count'] = Event::count() + 10;
        $data['member_count'] = Member::count();
        $data['financial_count'] = Financial::where('financial_type', 'income')->sum('financial_amount');
        $data['documentation_count'] = Documentation::count();

        return view('landing.index', compact('event', 'data'));
    }

    public function finance(Request $request){
        $data['action'] = ['table_datatable_basic', 'uc_select2', 'form_pickers'];;
        $data['page_title']  = 'Keuangan';
        $data['card_title']  = 'Keuangan';
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Keuangan'], ['name' => 'Daftar Keuangan']]);
        $data['financials']  = Financial::filter($request->all())->orderBy('created_at', 'desc')->get();
        $data['categories']  = FinancialCategory::get();
        $financialArray = $data['financials']->toArray();
        $incomeData = array_map(function($item) {
            if ($item['financial_type'] == 'income') {
                return $item['financial_amount'];
            }
        }, $financialArray);
        $expenseData = array_map(function($item) {
            if ($item['financial_type'] == 'expense') {
                return $item['financial_amount'];
            }
        }, $financialArray);
        $data['total_income'] = array_sum($incomeData);
        $data['total_expense'] = array_sum($expenseData);
        $data['total_balance'] = $data['total_income'] - $data['total_expense'];
        $data['video'] = '';
        $data['poster'] = '';
        $data['essay'] = '';
        $data['speech'] = '';
        $data['category'] = [];

        return view('landing.finance', compact('data'));
    }

    public function documentationIndex(){
        $data['action'] = ['table_datatable_basic', 'uc_select2', 'form_pickers'];
        $data['page_title']  = 'Dokumentasi';
        $data['card_title']  = 'Dokumentasi';
        $data['documentations'] = Documentation::orderBy('created_at', 'desc')->get();

        return view('landing.documentation', compact('data'));
    }
}
