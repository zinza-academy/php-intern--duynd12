<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Constants\Pagination;
use Error;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = User::with(['profiles','roles'])->paginate(Pagination::LIMIT_ELEMENT);
        return view('User.User',['data'=>$userData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::all();
        return view('User.AddUser',['data'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try{
            DB::beginTransaction();
            
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            Profile::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'dob' => $data['dob']
            ]);

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $data['role_id']
            ]);

            DB::commit();
            Notify::success('Thêm thành công user');
            return Redirect::to('/addUser');
        }
        catch(Error $e){
            DB::rollBack();
            Notify::success($e->getMessage());
        }
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
        $data = User::whereId($id)->with(['profiles','roles'])->first();
        $roles = Role::all();

        return view('User.EditUser',[
            'data'=>$data,
            'roles'=>$roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
