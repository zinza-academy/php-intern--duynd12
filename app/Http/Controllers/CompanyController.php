<?php

namespace App\Http\Controllers;

use App\Constants\Pagination;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use App\Services\ImageService;
use App\Services\PaginatorService;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    protected $imageService;
    protected $companyService;
    protected $paginatorService;

    // create construct

    public function __construct(ImageService $imageService, CompanyService $companyService, PaginatorService $paginatorService)
    {
        $this->imageService = $imageService;
        $this->companyService = $companyService;
        $this->paginatorService = $paginatorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $column = 'active';

        $data = $this->companyService->getDataTrashed(['users.profiles']);

        $data = $this->paginatorService->paginate($request, $column, $data);
        $param = $this->paginatorService->getParam($request, $column);

        return view('company.Company', ['data' => $data, 'param' => $param]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.addCompany');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        $data = $this->imageService->checkSizeImage($request, 'logo', $data);
        try {
            Company::create($data);
            Notify::success('Them thanh cong');
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }

        return redirect()->back()->withInput($request->input());
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
        $companyData = $this->companyService->find($id);
        return view('company.editCompany', ['data' => $companyData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $data = $request->only(['name_company', 'address', 'max_users', 'expired_time', 'active', 'logon']);
        try {
            $this->companyService->update($id, $data);
            Notify::success("Update thanh cong");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }

        return back()->withInput($request->input());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->companyService->delete($id);
            Notify::success("Xoa thanh cong");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }
        return back();
    }
}
