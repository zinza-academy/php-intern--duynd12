<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Constants\Pagination;
use app\Constants\StatusConstants;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
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
    public function index(Request $request)
    {
        $column = 'status';

        $userData = User::with('profiles', 'roles')
            ->withTrashed();
        $param = $request->query($column);
        if ($param !== null) {
            $userData = $userData->orderBy($column, $param)->paginate(Pagination::LIMIT_ELEMENT);
        } else {
            $userData = $userData->paginate(Pagination::LIMIT_ELEMENT);
        }
        return view('User.User', ['data' => $userData, 'param' => $param]);
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
        try {
            DB::beginTransaction();

            User::findOrFail($id)->delete();
            $this->userService->update($id, ['status' => StatusConstants::NO_ACTIVE]);

            DB::commit();
            Notify::success("Xoa thanh cong");
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error("Xoa that bai");
        }
        // User::where('id',$id)->update([
        //     'status'=>"No Active"
        // ]);
        return redirect()->route('user.index');
    }

    // delete many user 

    public function deleteUsers(Request $request)
    {

        $userIds = $request->input('ids');
        User::whereIn('id', $userIds)->delete();

        return response()->json(['message' => 'Users deleted successfully']);
    }
}
