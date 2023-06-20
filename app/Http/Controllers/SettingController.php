<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Profile;
use App\Models\User;
use App\Services\ImageService;
use App\Services\LoginService;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    protected $loginService;
    protected $imageService;
    private $id;

    //ham khoi tao 

    public function __construct(LoginService $loginService,ImageService $imageService)
    {
        $this->loginService = $loginService;
        $this->imageService = $imageService;
    }


    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $this->id = $this->loginService->getSessionId();
        $data = User::with('Profiles')->whereId($this->id)->get();
        return view ('setting',[
            'data'=>$data,
            'breadcrumbs'=>['Home','Setting']
        ]);
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
    public function update(SettingRequest $request)
    {
        $data = $request->all();
        $id = $this->loginService->getSessionId();
        $userData = User::find($id);
        if ($request->file('avatar')->isValid()) {
            $image_name = $this->imageService->storeImage($request);
            $data['avatar'] = $image_name;
        } else {
            Notify::error("File không hợp lệ");
            return Redirect::to('/setting');
        }
        $password = $userData['password'];
        $oldPassword = $data['oldPassword'];
        $newPassword = $data['password'];
        unset($data['email']);
        if ($oldPassword == null) {
            unset($data['oldPassword']);
            unset($data['confirmPassword']);
            unset($data['password']);
        }
        else{
            $boolean = Hash::check($oldPassword,$password);
        }
        try{
            DB::beginTransaction();
            if (isset($boolean) && $boolean) {
                User::findOrFail($id)->update([
                    'password' => Hash::make($newPassword)
                ]);
            }
            else if ($oldPassword !== null) {
                Notify::error("Mật khẩu cũ không đúng");
                return Redirect::to('/setting');
            }
            Profile::whereUserId($id)->update([
                'name'=>$data['name'],
                'dob'=>$data['dob'],
                'avatar'=>$data['avatar']
            ]);
            DB::commit();
            Notify::success("Update thành công");
        }
        catch(Error $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
        }

        return Redirect::to('/setting');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
