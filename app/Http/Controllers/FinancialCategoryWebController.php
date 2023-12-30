<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Helper\RedirectHelper as R;
use App\Http\Requests\FinancialCategoryRequest;
use App\Models\FinancialCategory;
use Illuminate\Http\Request;

class FinancialCategoryWebController extends Controller
{
    public function index()
    {
        $data['action'] = ['table_datatable_basic', 'uc_select2'];
        $data['page_title'] = 'Semua Member';
        $data['card_title'] = 'Member';
        $data['financial_categories'] = FinancialCategory::get();
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Finansial Kategori'], ['name' => 'Daftar Kategori']]);

        return view('admin.financial-category.index', compact('data'));
    }

    public function store(FinancialCategoryRequest $request )
    {
        try {
            $data = $request->validated();
            FinancialCategory::create($data);
            return R::redirectRouteStatus('admin.financial-category.index','success','Kategori berhasil ditambahkan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }
    }

    public function update(FinancialCategoryRequest $request, FinancialCategory $financialCategory)
    {
        try {
            $data = $request->validated();
            $financialCategory->update($data);
            return R::redirectRouteStatus('admin.financial-category.index','success','Member berhasil diupdate');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }
    }

    public function destroy(FinancialCategory $financialCategory)
    {
        try {
            $financialCategory->delete();
            return R::redirectRouteStatus('admin.financial-category.index','success','Member berhasil dihapus');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }
    }
}
