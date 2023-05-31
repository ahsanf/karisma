<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Helper\RedirectHelper as R;

class TagWebController extends Controller
{
    public function index()
    {

        $data['action'] = ['table_datatable_basic', 'uc_select2'];
        $data['page_title'] = 'Semua Tag';
        $data['card_title'] = 'Tag';
        $data['tags'] = Tag::withCount('members')->get();
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Tag'], ['name' => 'Daftar Tag']]);

        return view('admin.tag.index', compact('data'));
    }

    public function store(TagRequest $request)
    {
        try {
            $data = $request->validated();
            Tag::create($data);
            return R::redirectRouteStatus('admin.tag.index', 'success', 'Tag berhasil ditambahkan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function update(TagRequest $request, Tag $tag)
    {
        try {
            $data = $request->validated();
            $tag->update($data);
            return R::redirectRouteStatus('admin.tag.index', 'success', 'Tag berhasil diupdate');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return R::redirectRouteStatus('admin.tag.index', 'success', 'Tag berhasil dihapus');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }
}
