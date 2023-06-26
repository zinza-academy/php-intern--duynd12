<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\User;
use App\Services\ImageService;
use App\Services\LoginService;
use App\Services\SettingService;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class SettingController extends Controller {
    protected $loginService;
    protected $imageService;
    protected $settingService;
    private $id;

    //ham khoi tao 

    public function __construct(LoginService $loginService, ImageService $imageService, SettingService $settingService)
    {
        $this->loginService = $loginService;
        $this->imageService = $imageService;
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $this->id = $this->loginService->getSessionId();
        $data = User::with('profiles')->find($this->id);
        return view('setting', [
            'data' => $data,
            'breadcrumbs' => ['Home', 'Setting']
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
        $data = $request->all();
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
        $this->settingService->update($request);
        return Redirect::back()->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
