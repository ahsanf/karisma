<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Http\Requests\MemberStoreRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Helper\RedirectHelper as R;
use App\Models\Tag;

class MemberWebController extends Controller
{
    public function index()
    {
        $data['action'] = ['table_datatable_basic', 'uc_select2'];
        $data['page_title'] = 'Semua Member';
        $data['card_title'] = 'Member';
        $data['members'] = Member::with('tag')->get();
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Member'], ['name' => 'Daftar Member']]);
        $data['tags'] = Tag::get();

        return view('admin.member.index', compact('data'));
    }

    public function store(MemberStoreRequest $request )
    {
        try {
            $data = $request->validated();
            $member = Member::create($data);
            if($request->has('tags')){
                foreach($request->tags as $tag){
                    $member->tag()->attach($tag);
                }
            }
            return R::redirectRouteStatus('admin.member.index','success','Member berhasil ditambahkan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }
    }

    public function update(MemberStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $member = Member::find($request->id);
            $member->update($data);
            if($request->has('tags')){
                $member->tag()->sync($request->tags);
            }
            return R::redirectRouteStatus('admin.member.index','success','Member berhasil diupdate');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }
    }

    public function destroy(Member $member)
    {
        try {
            $member->tag()->detach();
            $member->delete();
            return R::redirectRouteStatus('admin.member.index','success','Member berhasil dihapus');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }
    }

}
