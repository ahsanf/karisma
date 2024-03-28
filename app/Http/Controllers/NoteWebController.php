<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Helper\RedirectHelper as R;
use App\Http\Requests\NoteRequest;
use App\Models\Event;
use App\Models\Note;

class NoteWebController extends Controller
{
    public function index()
    {

        $data['action']     = ['table_datatable_basic', 'uc_select2'];
        $data['page_title'] = 'Semua Catatan';
        $data['card_title'] = 'Catatan';
        $data['notes']      = Note::orderByDesc('created_at')->with('event')->get();
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Catatan'], ['name' => 'Daftar Catatan']]);

        return view('admin.note.index', compact('data'));
    }

    public function create()
    {
        $data['action']     = ['form_editor_summernote','uc_select2', 'form_pickers'];
        $data['page_title'] = 'Tambah Catatan';
        $data['card_title'] = 'Tambah Catatan';
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Catatan'], ['name' => 'Tambah Catatan']]);
        $data['events']     = Event::get();

        return view('admin.note.create', compact('data'));
    }

    public function edit(Note $note)
    {
        $data['action']      = ['form_editor_summernote','uc_select2'];
        $data['page_title']  = 'Edit Catatan';
        $data['card_title']  = 'Edit Catatan';
        $data['note']        = $note->load('event')->toArray();
        $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Catatan'], ['name' => 'Edit Catatan']]);
        $data['events']      = Event::select('id', 'event_name')->get()->toArray();

        return view('admin.note.edit', compact('data'));
    }

    public function store(NoteRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $note = Note::findOrFail($id);
            $note->update($data);
            return R::redirectRouteStatus('admin.note.index', 'success', 'Catatan berhasil disimpan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function autoSave(Request $request) {
        try {
            $data = $request->all();
            if($data['id'] != '')
            {
                $note = Note::find($data['id']);
                $note->note_content = $data['note_content'];
                $note->save();
            } else {
                $note = Note::create($data);
            }

            return response()->json(['id' => $note->id,'status' => 'success', 'message' => 'Berhasil disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }

    }

    public function update(NoteRequest $request, Note $note)
    {
        try {
            $data = $request->validated();
            $note->update($data);
            return R::redirectRouteStatus('admin.note.index', 'success', 'Catatan berhasil diupdate');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }

    public function destroy(Note $note)
    {
        try {
            $note->delete();
            return R::redirectRouteStatus('admin.note.index', 'success', 'Catatan berhasil dihapus');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error', $th->getMessage());
        }
    }
}
