<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Models\User;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    public function __construct(
        UserRepository $userRepository, 
        RoleRepository $roleRepository
    ) {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index() {
        return view('user.index');
    }

    public function datatables() {
        return $this->userRepository->datatables();
    }

    public function create() {
        $roles = $this->roleRepository->getAll();

        return view('user.create', compact('roles'));
    }

    public function store(UserRequest $request) {
        $save = $this->userRepository->save($request->all());

        if ($save) {
            \Session::flash("alert-success", "User successfully saved");
        } else {
            \Session::flash("alert-error", "User unsuccessfully saved");
        }

        return redirect()->route('user');
    }

    public function edit(User $user) {
        $roles = $this->roleRepository->getAll();

        return view('user.edit', compact('roles','user'));
    }

    public function update(UserRequest $request, User $user) {
        $update = $this->userRepository->update($request, $user);

        if ($update) {
            \Session::flash("alert-success", "User successfully updated");
        } else {
            \Session::flash("alert-error", "User unsuccessfully updated");
        }

        return redirect()->route('user');
    }

    public function destroy(User $user) {
        $destroy = $this->userRepository->destroy($user->id);

        if ($destroy) {
            \Session::flash("alert-success", "User successfully destroyed");
        } else {
            \Session::flash("alert-error", "User unsuccessfully destroyed");
        }

        return redirect()->route('user');
    }
}
