<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
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
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());

        $this->authService->login(
            email: $user->email,
            password: $request->validated()['password'],
            remember: false,
        );

        return redirect()->route('dashboard');
    }
}

