<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \App\Http\Resources\UserResource
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function show(Request $request, User $user)
    {
        $user = User::find($id);

        return new UserResource($user);
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user = User::find($id);

        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \App\Http\Resources\UserResource
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return new UserResource($user);
    }
}
