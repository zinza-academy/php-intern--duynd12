<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Constants\Pagination;
use app\Constants\StatusConstants;
use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Services\PaginatorService;
use App\Services\UserService;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;
    private $paginatorService;
    /*
        create function construct
    */

    public function __construct(UserService $userService, PaginatorService $paginatorService)
    {
        $this->userService = $userService;
        $this->paginatorService = $paginatorService;
    }

    /*
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $column = 'status';

        $userData = $this->userService->all(['profiles']);

        $userData = $this->paginatorService->sortData($request, $column, $userData);
        $userData = $userData->paginate(Pagination::LIMIT_ELEMENT);
        $param = $this->paginatorService->getParam($request, $column);

        return view('User.User', ['data' => $userData, 'param' => $param]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id');
        return view('User.AddUser', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $userRequest)
    {
        $payload = $userRequest->all();
        $payload['password'] = Hash::make($payload['password']);
        $this->userService->insertData($payload, $userRequest);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = User::whereId($id)->with(['profiles'])->first();
        $companies = Company::all();

        return view('User.EditUser', [
            'data' => $data,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, int $id)
    {
        $this->userService->updateData($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();

            User::findOrFail($id)->delete();

            DB::commit();
            Notify::success("Xoa thanh cong");
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error("Xoa that bai");
        }

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
