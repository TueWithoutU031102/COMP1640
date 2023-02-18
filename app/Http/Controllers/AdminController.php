<?php

namespace App\Http\Controllers;

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
        $users = User::all();
        return view('Goodi.admin.acc', ['users' => $users]);
    }

    public function createAcc(Request $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);

        $user->image = $this->saveImage($request->file('image'));

        $user->save();
        return redirect('admin/acc')->with('errors', 'Create Successful!!!!!');
    }


    public function showAcc($id)
    {
        $account = User::find($id);
        return view('Goodi/admin/showAcc')->with('account', $account);
    }

    public function editAcc($id)
    {
        $account = User::find($id);
        return view('Goodi/admin/editAcc')->with('account', $account);
    }

    public function updvVateAcc(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
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

    public function sub()
    {
        $subs = Submission::all();
        return view('Goodi/admin/sub', ['subs' => $subs]);
    }

    public function createSub(Request $request)
    {
        $submission = new Submission($request->all());
        $submission->save();
        return redirect('admin/sub')->with('success', 'submission created successfully');
    }

}
