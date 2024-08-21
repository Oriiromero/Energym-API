<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        $user->update($request->all());
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['message' => "User {$user->name} deleted successfully."]);
    }


}
