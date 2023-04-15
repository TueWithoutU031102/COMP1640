<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUser;
use Illuminate\Http\UploadedFile;
use App\Services\IdeaService;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    protected IdeaService $ideaService;
    protected User $currentUser;
    public function __construct(IdeaService $ideaService)
    {
        $this->ideaService = $ideaService;
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
    }
    public function index()
    {
        $account = User::find(Auth::user()->id);
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        $listDepartments = Department::all();
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        return view(
            'Goodi/User/index',
            [
                'listIdeas' => $listIdeas,
                'account' => $account,
                'listRoles' => $listRoles,
                'listDepartments' => $listDepartments
            ]
        );
    }

    public function update(UpdateUser $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => [Rule::unique('users')->ignore($request->id)],
            'phone_number' => [Rule::unique('users')->ignore($request->id)],
            'image' => ['image','required'],
        ]);

        if ($request->hasFile('image')) {
            User::find($request->id)->removeImage();
            $input['image'] = $this->saveImage($request->file('image'));
        } else
            $input['image'] = User::find($input['id'])->image;

        if (!$input['role_id']) $input['role_id'] = User::find($input['id'])->role_id;

        if (!$input['department_id']) $input['department_id'] =  User::find($input['id'])->department_id;

        !$input['password'] ? $input['password'] = User::find($input['id'])->password
            : $input['password'] = Hash::make($request->password);

        User::find($request->id)->update($input);

        return redirect('user/index')->with('success', 'Account updated successfully');
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
