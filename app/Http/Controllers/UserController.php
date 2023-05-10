<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->get('password'))
        ])->all());


        return redirect('user.index')->with('status_success', __('User successfully created.'));
    }

    public function destroy(User $model, string $id)
    {
        $user = $model->find($id);

        if(!$user){
            return redirect()->route('user.index')->with('status_warning', __('User not found.'));
        }
        
        $user->delete();

        return redirect()->route('user.index')->with('status_danger', __('Deleted User.'));

    }

    public function edit(User $model, string $id)
    {
        $user = $model->find($id);

        if(!$user){
            return redirect()->route('user.index')->with('status_warning', __('User not found.'));
        }

        return view('users.edit', ['user' => $user]);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
       $user = User::find($id);

       $user->update($request->only(['name','email']));

        return redirect()->route('user.index')->with('status_success', __('User successfully updated.'));

    }

    public function password()
    {
        //..
    }
}
