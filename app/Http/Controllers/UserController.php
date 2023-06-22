<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Constants\Pagination;
use App\Http\Requests\UserRequest;
use App\Services\UserService;


class UserController extends Controller
{
    private $userService;

    /*
        create function construct
    */

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = User::with(['profiles', 'roles'])->paginate(Pagination::LIMIT_ELEMENT);
        return view('User.User', ['data' => $userData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::all();
        return view('User.AddUser', ['data' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->userService->insertData($request);
        // $this->userService->saveData($this->userService->insertData($request));
        return redirect()->back()->withInput($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::whereId($id)->with(['profiles', 'roles'])->get();
        $roles = Role::all();
        return view('User.EditUser', [
            'data' => $data,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $this->userService->updateData($request, $id);
        return redirect()->back()->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
