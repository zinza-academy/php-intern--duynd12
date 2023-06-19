<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Services\LoginService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $loginService ;
    private $id;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function index()
    {
        $this->id = $this->loginService->getSessionId();
        $data = User::with('Profiles')->whereId($this->id)->get();
        return view ('setting',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> all();
        dd($data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $this->loginService->getSessionId();
        $data = $request->all();
        $oldPassword = $data['oldPassword'];
        if($oldPassword == null){
            unset($data['oldPassword']);
            unset($data['confirmPassword']);
            unset($data['password']);
        }
        // dd($data);
        User::findOrFail($id)->update([
            'email' => $data['email']
        ]);
        Profile::whereUserId($id)->update([
            'name' => $data['name'],
            'dob' => $data['dob'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
