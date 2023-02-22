<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function acc()
    {
        $users = User::where('role_id', '!=', '1')->get();
        return view('Goodi.admin.user.acc', ['users' => $users]);
    }

    function showFormCreateAccount()
    {
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        return view('Goodi/admin/user/createAcc')->with('listRoles', $listRoles);
    }

    public function createAcc(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['email'],
            'password' => ['gt:1'],
            'phone_number' => ['digits:10', 'starts_with:0'],
            'DoB' => ['required', 'before_or_equal:today'],
            'image' => ['image', 'required'],
            'role_id' => ['required'],
        ]);
        $user = new User($request->all());
        $user->password = Hash::make($request->password);

        $user->image = $this->saveImage($request->file('image'));

        $user->save();
        return redirect('admin/acc')->with('errors', 'Create Successful!!!!!')
            ->with('listRole');
    }


    public function showAcc($id)
    {
        if ($id == 1) return redirect('admin/acc')->with('success', 'You must not see this account');
        $account = User::find($id);
        return view('Goodi/admin/user/showAcc')->with('account', $account);
    }

    public function showFormEditAccount($id)
    {
        $account = User::find($id);
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        return view('Goodi/admin/user/editAcc')
            ->with('account', $account)
            ->with('listRoles', $listRoles);
    }

    public function updateAcc(Request $request)
    {

        $existedImage = $request->existedImage;
        $input = $request->all();
        if ($request->image == null) {
            $input['image'] = $existedImage;
        }

        $id = $request->id;
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['email'],
            'password' => ['gt:1'],
            'phone_number' => ['digits:10', 'starts_with:0'],
            'DoB' => ['required', 'before_or_equal:today'],
            'role_id' => ['required'],
        ]);
        User::find($id)->update($input);
        return redirect('admin/acc')->with('success', 'account updated successfully');
    }

    public function delete(User $user)
    {
        $user->removeImage();
        $user->delete();
        return redirect('admin/acc')->with('success', 'account deleted successfully');
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
