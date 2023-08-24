<?php

namespace App\Http\Controllers\api;

use App\Constants\Pagination;
use App\Events\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\UserUpdateRequest as SettingRequestApi;
use App\Http\Requests\api\UserUpdateRequest;

use App\Models\Comment;
use App\Models\Profile;
use App\Models\User;
use App\Services\api\ProfileService as ApiProfileService;
use App\Services\api\UserService as ApiUserService;
use App\Services\ImageService;
use App\Services\ProfileService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    private $userService;
    private $imageService;
    private $profileService;
    private $apiProfileService;
    private $apiUserService;

    //construct function
    public function __construct(
        UserService $userService,
        ImageService $imageService,
        ProfileService $profileService,
        ApiProfileService  $apiProfileService,
        ApiUserService $apiUserService
    ) {
        $this->userService = $userService;
        $this->profileService = $profileService;
        $this->imageService = $imageService;
        $this->apiProfileService = $apiProfileService;
        $this->apiUserService = $apiUserService;
        Auth::setDefaultDriver('api');
    }

    // function login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Sai thông tin tài khoản hoặc mật khẩu']);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = User::with(['profile'])->findOrFail(JWTAuth::user()->id);

        return response()->json(compact('user', 'token'));
    }

    /**
     * Refresh a token.
     *
     */
    public function refresh()
    {
        $token = JWTAuth::parseToken()->refresh();

        return response()->json([
            'access_token' => $token
        ]);
    }

    //function get all users by name
    public function getAllUserByName()
    {
        $users = User::with('profile')->get();
        $users = $users->pluck('profile.name', 'profile.user_id');

        return response()->json([
            'users' => $users,
            'status' => 200
        ]);
    }

    //function get top users
    public function topUsers()
    {
        $topUsers = Comment::with('user.profile')
            ->where('resolve', true)
            ->groupBy('user_id')
            ->select('user_id', DB::raw('COUNT(resolve) as resolve_count'))
            ->get();

        return response()->json([
            'topUsers' => $topUsers,
            'status' => 200
        ]);
    }

    // function get info user by token
    public function getMe()
    {
        $userId = JWTAuth::user()->id;
        $user = User::with(['profile'])->findOrFail($userId);

        return response()->json([
            'data' => $user
        ]);
    }

    //function update info user
    public function updateUser(SettingRequestApi $request)
    {
        $user = $request->validated();
        $userId = JWTAuth::user()->id;
        $userInfoById = User::findOrFail($userId);
        $user = $this->imageService->checkSizeImage($request, 'avatar', $user);
        if (isset($user['password'])) {
            $user['password'] = Hash::make($user['password']);
            $boolean = Hash::check($user['oldPassword'], $userInfoById['password']);
        } else {
            unset($user['password']);
        }
        try {
            DB::beginTransaction();

            if (isset($boolean) && $boolean) {
                $this->userService->update($userId, $user);
            } else if (isset($user['password'])) {

                return response()->json([
                    'message' => 'Mật khẩu cũ không đúng',
                    'data' => $user
                ]);
            }
            $dataProfile = $this->apiProfileService->getDataProfile($user);
            DB::table('profiles')
                ->where('user_id', $userId)
                ->update($dataProfile);
            DB::commit();

            return response()->json([
                'message' => "Sửa thành công",
                'status' => 204
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    //function get all users
    public function getAllUsers()
    {
        $users = User::with(['profile'])->paginate(Pagination::LIMIT_RECORD);

        return response()->json([
            'data' => $users
        ]);
    }

    // function add user
    public function store(AddUserRequest $userRequest)
    {
        $user = $userRequest->validated();
        $idCompanyUser = JWTAuth::user()->company_id;
        $roleUser = JWTAuth::user()->role;
        $user['password'] = Hash::make($user['password']);
        try {
            if ($idCompanyUser != $user['company_id'] && $roleUser != 1) {

                return response()->json([
                    'message' => 'Không thể assign công ty mình phải chủ',
                ]);
            }
            $this->apiUserService->createUser($user);

            return response()->json([
                'message' => 'Thêm thành công',
                'status' => 201
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    //get user by id
    public function getUserById(int $id)
    {
        $user = User::with(['profile'])->findOrFail($id);

        return response()->json([
            'data' => $user
        ]);
    }

    //update info user
    public function updateInfoUser(UserUpdateRequest $request, int $id)
    {
        $dataProfile = $request->only(['name', 'dob']);
        $dataUser = $request->validated();
        try {
            DB::beginTransaction();

            $this->userService->update($id, $dataUser);
            Profile::where('user_id', $id)->update($dataProfile);
            if (JWTAuth::user()->role == 1) {
                $this->apiUserService->checkAmountUser($dataUser);
            }
            DB::commit();

            return response()->json([
                'message' => 'Sửa thành công',
                'status' => 204
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            User::findOrFail($id)->delete();

            return response()->json([
                'message' => 'Xoá thành công',
                'status' => 200
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    // delete many user
    public function deleteUsers(Request $request)
    {
        try {
            $userIds = $request->get('listUsers');
            User::whereIn('id', $userIds)->delete();

            return response()->json([
                'message' => 'Xóa thành công',
                'status' => 200
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    //function logout
    public function logout()
    {
        JWTAuth::setBlacklistEnabled(true);
        Auth::logout();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully logged out',
            'jwtBlack' => config('jwt.blacklist_enabled')
        ]);
    }
}
