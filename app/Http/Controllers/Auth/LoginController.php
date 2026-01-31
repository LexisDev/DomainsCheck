<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function create(Request $request)
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $this->authService->login(
            email: $request->validated()['email'],
            password: $request->validated()['password'],
            remember: (bool) $request->validated()['remember'],
        );

        return redirect()->route('dashboard');
    }
}

