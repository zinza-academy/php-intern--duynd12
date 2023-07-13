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

class CompanyController extends Controller
{
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
        $column = 'status';

        $data = $this->companyService->all(['users.profile']);

        $data = $this->paginatorService->sortData($request, $column, $data);
        $data = $data->paginate(Pagination::LIMIT_RECORD);
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

            Notify::success('Thêm thành công');
        } catch (Exception $e) {
            Notify::error($e->getMessage());
            return back()->withInput($request->input());
        }

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
        $companyData = $this->companyService->find($id);

        return view('company.editCompany', ['data' => $companyData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, int $id)
    {
        $data = $request->validated();
        $data = $this->imageService->checkSizeImage($request, 'logo', $data);
        try {
            $this->companyService->update($id, $data);

            Notify::success("Sửa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());

            return back()->withInput($request->input());
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->companyService->delete($id);
            Notify::success("Xóa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }
        return back();
    }
}
