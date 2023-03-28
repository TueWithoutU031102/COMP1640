<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\IdeaService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenController extends Controller
{
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
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        return view('Goodi/User/index')
            ->with('listIdeas', $listIdeas);
    }
    public function getCsrfToken(Request $request): string
    {
        $token = csrf_token();
        Session::put('_token', $token); // Lưu token vào session để sử dụng trong các request khác
        return $token;
    }

    public function getCurrentUserFromJWT(Request $request):JsonResponse
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['user_not_found'], 404);
            }
            return response()->json(['user' => $user, 'role' => $user->role->name], 200);

        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired']);
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid']);
        } catch (JWTException $e) {
            return response()->json(['token_absent']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
