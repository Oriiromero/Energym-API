<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }
    public function index(Request $request) 
    {
        $filter = new UserFilter();
        $filterItems = $filter->transform($request);

        $users = User::where($filterItems); 

        return new UserCollection($users->paginate()->appends($request->query()));
    }

    public function show(User $user) 
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user) 
    {
        $admin = Auth::user();
        
        $user->update($request->all());

        $this->auditLogService->storeAction('update', 'users', $user->id, $admin->id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $admin = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->delete();

        $this->auditLogService->storeAction('delete', 'users', $user->id, $admin->id);

        return response()->json(['message' => "User {$user->name} deleted successfully."]);
    }


}
