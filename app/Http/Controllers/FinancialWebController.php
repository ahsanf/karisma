<?php

namespace App\Http\Controllers;

use App\Helper\FileHelper;
use App\Helper\RedirectHelper as R;
use App\Helper\LayoutHelper;
use App\Http\Requests\FinancialRequest;
use App\Models\Financial;
use App\Models\FinancialCategory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FinancialWebController extends Controller
{

    public function index(Request $request)
    {
        $data['action']      = ['table_datatable_basic', 'uc_select2', 'form_pickers'];
        $data['page_title']  = 'Daftar Keuangan';
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

        return view('admin.finance.index', compact('data'));
    }

    public function store(FinancialRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('financial_file')) {
                $file       = $request->file('financial_file');
                $store_file = $this->uploadFile($file);
                $path = Financial::getFilePath().DIRECTORY_SEPARATOR.$store_file;
                $data['file_path'] = $path;
                $data['file_name'] = $store_file;
            }
            $data['financial_amount'] = (int) str_replace('.','',$request->financial_amount);
            Financial::create($data);

            return R::redirectRouteStatus('admin.finance.index', 'success', 'Keuangan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $financial = Financial::findOrFail($id);
            $financial->delete();

            return R::redirectRouteStatus('admin.finance.index', 'success', 'Keuangan berhasil dihapus');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function update(FinancialRequest $request, Financial $financial)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('financial_file')) {
                $file       = $request->file('financial_file');
                $store_file = $this->uploadFile($file);
                $path = Financial::getFilePath().DIRECTORY_SEPARATOR.$store_file;
                $data['file_path'] = $path;
                $data['file_name'] = $store_file;
            }
            $financial->update($data);

            return R::redirectRouteStatus('admin.finance.index', 'success', 'Keuangan berhasil diupdate');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function uploadFile(UploadedFile $uploadedFile)
    {
        $file       = new FileHelper();
        $store_file = $file->handle($uploadedFile, Financial::getUploadPath());

        return $store_file;
    }
}
