<?php

namespace App\Http\Controllers;

use App\Helper\LayoutHelper;
use App\Helper\RedirectHelper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminWebController extends Controller
{

    public function index()
    {
        try {
            $data['action'] = ['table_datatable_basic', 'uc_select2'];
            $data['page_title'] = 'Admin Management';
            $data['users'] = User::get();
            $data['breadcrumbs'] = LayoutHelper::setBreadcrumbs([['name' => 'Lain-lain'], ['name' => 'Daftar Admin']]);
            return view('admin.user.index', compact('data'));
        } catch (\Throwable $th) {

            return RedirectHelper::redirectBackStatus('error', $th->getMessage());
        }


    }

    public function store(UserRequest $request)
    {
        try {
            $password = Hash::make($request->password);
            $data = $request->all();
            $data['password'] = $password;
            $user = User::create($data);
            $user->assignRole('admin');
            return RedirectHelper::redirectRouteStatus('admin.user.index', 'success', 'User has been created');
        } catch (\Throwable $th) {
            return RedirectHelper::redirectBackStatus('error', $th->getMessage());
        }


    }


    public function update(Request $request, User $user)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            ]);


            if ($validator->fails()) {
                $error = $validator->errors()->all(':message');
                return RedirectHelper::redirectBackStatus('warning', 'Data not valid, error: ' . implode(' ', $error));
            }

            $user->update($request->all());


            return RedirectHelper::redirectRouteStatus('admin.user.index', 'success', 'User has been updated');
        } catch (\Throwable $th) {
            return RedirectHelper::redirectBackStatus('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->roles()->detach();
            $user->delete();
            return RedirectHelper::redirectRouteStatus('admin.user.index', 'success', 'User has been deleted');
        } catch (\Throwable $th) {
            return RedirectHelper::redirectBackStatus('error', $th->getMessage());
        }
    }
}
