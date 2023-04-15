<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Account\createAcc;
use App\Http\Requests\Account\updateAcc;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function acc()
    {
        $users = User::where('role_id', '!=', '1')->get();
        return view('Goodi/Account/acc', ['users' => $users]);
    }

    function showFormCreateAccount()
    {
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        $listDepartments = Department::all();
        return view('Goodi/Account/createAcc')->with('listRoles', $listRoles)->with('listDepartments', $listDepartments);
    }

    public function createAcc(createAcc $request)
    {
        $user = new User($request->all());

        $user->password = Hash::make($request->password);

        $user->image = $this->saveImage($request->file('image'));
        if ($request->input('role_id') == '4') {
            $user['department_id'] = NULL;
        }

        $user->save();
        return redirect()->route('admin.acc')->with('success', 'Create Successful!!!!!')
            ->with('listRole');
    }

    public function showAcc($id)
    {
        if ($id == 1) return redirect('admin/acc')->with('success', 'You must not see this Account');
        $account = User::find($id);
        $nameDepart = Department::find(User::find($id)->department_id);
        return view('Goodi/Account/showAcc', ['account' => $account, 'nameDepart' => $nameDepart]);
    }

    public function showFormEditAccount($id)
    {
        $account = User::find($id);
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        $listDepartments = Department::all();
        return view('Goodi/Account/editAcc')
            ->with('account', $account)
            ->with('listRoles', $listRoles)
            ->with('listDepartments', $listDepartments);
    }

    public function updateAcc(updateAcc $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'image' => ['image','required'],
            'email' => [Rule::unique('users')->ignore($request->id)],
            'phone_number' => [Rule::unique('users')->ignore($request->id)], 
        ]);

        if ($request->hasFile('image')) {
            User::find($request->id)->removeImage();
            $input['image'] = $this->saveImage($request->file('image'));
        } else
            $input['image'] = User::find($input['id'])->image;

        if ($request->input('role_id') == '4') $input['department_id'] = NULL;

        if ($input['password'] == null) $input['password'] = User::find($input['id'])->password;
        else $input['password'] = Hash::make($request->password);

        User::find($request->id)->update($input);

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
