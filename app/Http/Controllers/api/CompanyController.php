<?php

namespace App\Http\Controllers\api;

use App\Constants\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use App\Services\ImageService;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $imageService;
    private $companyService;

    public function __construct(ImageService $imageService, CompanyService $companyService)
    {
        $this->imageService = $imageService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with(['users.profile'])->paginate(Pagination::LIMIT_RECORD);

        return response()->json([
            'data' => $companies,
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        if ($data['logo']) {
            $data = $this->imageService->checkSizeImage($request, 'logo', $data);
        }
        try {
            Company::create($data);

            return response()->json([
                'message' => "Thêm thành công",
                'status' => 201
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Thêm thất bại",
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $company = $this->companyService->find($id);

        return response()->json([
            'data' => $company
        ]);
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

            return response()->json([
                'message' => "Sửa thành công",
                'status' => 200
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => "Sửa thất bại"
            ]);
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

            return response()->json([
                'message' => "Xóa thành công",
                'status' => 200
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 200
            ]);
        }
    }

    //function get name company
    public function getNameCompany()
    {
        $companies = Company::pluck('name', 'id');

        return response()->json([
            'data' => $companies
        ]);
    }
}
