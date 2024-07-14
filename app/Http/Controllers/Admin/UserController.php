<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\DataNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.users.';

    public function index()
    {
        $users = User::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataUser = $request->all();
        $msg = 'Thêm mới tài khoản thành công!';
        try {
            DB::beginTransaction();

            if (isset($dataUser['avatar'])) {
                $dataUser['avatar'] = Storage::put('users', $dataUser['avatar']);
            }

            $user = User::query()->create($dataUser);

            DB::commit();

            return redirect()->route(self::PATH_VIEW . 'index')->with('msg', $msg);
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($user->toArray());
        $data = $request->except('_token', '_method');
        $msg = 'Cập nhật thành công';
        $avatarOld = $user->avatar;

        try {
            DB::beginTransaction();
            if (isset($data['avatar'])) {
                $data['avatar'] = Storage::put('users', $data['avatar']);
            }
            // throw new Exception("Error Processing Request", 1);
            
            $userUpdate = User::query()->where('id', $user->id)->update($data);

            DB::commit();

            return back()->with('msg', $msg);

            
        } catch (Exception $exception) {

            Storage::delete($data['avatar']);

            dd($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $msg = 'Xóa thành công!';
        $user->delete();
        return back()->with('msg', $msg);
    }
}
