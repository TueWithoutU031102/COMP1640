<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Account\createAcc;
use App\Http\Requests\Account\updateAcc;

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
        return view('Goodi/Account/createAcc')->with('listRoles', $listRoles);
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
        return view('Goodi/Account/showAcc')->with('account', $account);
    }

    public function showFormEditAccount($id)
    {
        $account = User::find($id);
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        return view('Goodi/Account/editAcc')
            ->with('account', $account)
            ->with('listRoles', $listRoles);
    }

    public function updateAcc(updateAcc $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $input['image'] = $this->saveImage($request->file('image'));
        }

        $input['password'] = Hash::make($request->password);
        $id = $request->id;
        User::find($id)->removeImage();
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
        //uniqid sinh ra m?? ng???u nhi??n, tham s??? ?????u t??? ?????ng n???i th??m v??o ?????ng tr?????c m??
        $name = uniqid("avatar_") . "." . $file->getClientOriginalExtension();
        //move_uploaded_file() l?? ????? l??u file ng d??ng ???? upload l??n server
        // getPathname() l?? l???y ???????ng d???n t???m th???i (???????ng d???n t???i file m?? ng d??ng upload l??n server)
        // public_path() l?? t???o ???????ng d???n tuy???t ?????i t??? file t???i ch??? m??nh c???n l??u file
        move_uploaded_file($file->getPathname(), public_path('images/' . $name));
        return "images/" . $name;
    }
}
