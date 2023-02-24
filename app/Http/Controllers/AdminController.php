<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\createAcc;
use App\Http\Requests\Admin\updateAcc;

class AdminController extends Controller
{
    public function index()
    {
        return Auth::guard('admin')->check()
            ? to_route('admin.index')
            : to_route('Goodi.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function acc()
    {
        $users = User::where('role_id', '!=', '1')->get();
        return view('Goodi/User/admin/Account/acc', ['users' => $users]);
    }

    function showFormCreateAccount()
    {
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        return view('Goodi/User/admin/Account/createAcc')->with('listRoles', $listRoles);
    }

    public function createAcc(createAcc $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);

        $user->image = $this->saveImage($request->file('image'));

        $user->save();
        return redirect()->route('admin.acc')->with('errors', 'Create Successful!!!!!')
            ->with('listRole');
    }


    public function showAcc($id)
    {
        if ($id == 1) return redirect('admin/acc')->with('success', 'You must not see this Account');
        $account = User::find($id);
        return view('Goodi/admin/user/showAcc')->with('Account', $account);
    }

    public function showFormEditAccount($id)
    {
        $account = User::find($id);
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        return view('Goodi/admin/user/editAcc')
            ->with('Account', $account)
            ->with('listRoles', $listRoles);
    }

    public function updateAcc(updateAcc $request)
    {
        $input = $request->except('image');
        $input['password'] = Hash::make($request->password);
        $id = $request->id;
        User::find($id)->update($input);
        return redirect('admin/acc')->with('success', 'Account updated successfully');
    }

    public function delete(User $user)
    {
        $user->removeImage();
        $user->delete();
        return redirect('admin/acc')->with('success', 'Account deleted successfully');
    }

    protected function saveImage(UploadedFile $file)
    {
        //uniqid sinh ra mã ngẫu nhiên, tham số đầu tự động nối thêm vào đằng trước mã
        $name = uniqid("avatar_") . "." . $file->getClientOriginalExtension();
        //move_uploaded_file() là để lưu file ng dùng đã upload lên server
        // getPathname() là lấy đường dẫn tạm thời (đường dẫn tới file mà ng dùng upload lên server)
        // public_path() là tạo đường dẫn tuyệt đối từ file tới chỗ mình cần lưu file
        move_uploaded_file($file->getPathname(), public_path('images/' . $name));
        return "images/" . $name;
    }
}
