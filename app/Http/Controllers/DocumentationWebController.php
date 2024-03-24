<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;
use Illuminate\Http\Request;
use App\Helper\RedirectHelper as R;

class DocumentationWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $data['action']      = ['table_datatable_basic', 'uc_select2', 'form_pickers'];
        $data['page_title']  = 'Semua Dokumentasi';
        $data['card_title']  = 'Dokumentasi';
        $data['documentations'] = Documentation::all();
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([
            ['name' => 'Dokumentasi'],
            ['name' => 'Daftar Dokumentasi']
        ]);

        return view('admin.documentation.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(DocumentationRequest $request)
    {
        try {
            $data = $request->validated();
            Documentation::create($data);
            return R::redirectRouteStatus('admin.documentation.index', 'success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('warning', 'Data tidak valid, error: ' . $th->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     */
    public function update(DocumentationRequest $request, Documentation $documentation)
    {
        try {
            $data = $request->validated();
            $documentation->update($data);
            return R::redirectRouteStatus('admin.documentation.index', 'success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('warning', 'Data tidak valid, error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy(Documentation $documentation)
    {
        try {
            $documentation->delete();
            return R::redirectRouteStatus('admin.documentation.index', 'success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('warning', 'Data tidak valid, error: ' . $th->getMessage());
        }
    }
}
