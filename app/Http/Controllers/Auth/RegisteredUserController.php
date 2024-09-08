<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Services\AuditLogService;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }
    public function store(Request $request): JsonResponse
    {
        $admin = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric'],
            'membership_status' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date'],
            'postal_code' => ['required', 'numeric']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'membership_status' => $request->membership_status,
            'birth_date' => $request->birth_date,
            'postal_code' => $request->postal_code

        ]);

        event(new Registered($user));

        // Auth::login($user);
        $token = $user->createToken('api-token');

        $this->auditLogService->storeAction('store', 'users', $user->id, $admin->id);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }
}
