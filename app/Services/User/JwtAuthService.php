<?php


namespace App\Services\User;

use App\Services\AuditTrailLogService;
use App\Traits\ResponseFormatterTrait;
use Illuminate\Http\{Response, JsonResponse};
use Illuminate\Support\Facades\{Hash, Auth};
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtAuthService
{
    use ResponseFormatterTrait;

    /**
     * @var UserService
     */

    private $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }
    /**
     * @param request $request
     * @return JsonResponse
     */
    public function signIn(array $request): JsonResponse
    {
        try {
            $user = $this->userService->getUserByEmail($request['email']);
            Hash::check($request['password'], $user->password);

            if (!$token = auth('api')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
                return $this->responseError(error: 'Invalid Credential!', status: Response::HTTP_UNAUTHORIZED, message: 'Unauthorized');
            }

            $data = [
                'user' => $user->toArray(),
                'authorization' =>  $this->respondWithToken($token),
            ];

            AuditTrailLogService::logAuditTrail('logged in', $user);

            return $this->responseSuccess('Success', data: $data);
        } catch (\Exception $err) {
            return $this->responseError(error: 'Invalid Credential!', status: Response::HTTP_UNAUTHORIZED, message: 'Unauthorized');
        }
    }

    /**
     * @param array $request
     * @return JsonResponse
     */
    public function signUp(array $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request);
            $token = Auth::login($user);

            $data = [
                'user' => $user->toArray(),
                'authorization' =>  $this->respondWithToken($token),
            ];
            return $this->responseSuccess('Success', $data);
        } catch (\Exception $e) {
            return $this->responseError(error: $e->getMessage(), status: Response::HTTP_INTERNAL_SERVER_ERROR, message: 'Internal Server Error');
        }
    }

    public function signOut(): JsonResponse
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return $this->responseError(error: 'Invalid Credential!', status: Response::HTTP_UNAUTHORIZED, message: 'Unauthorized');
            }
            AuditTrailLogService::logAuditTrail('logged out', Auth::user());
            auth()->logout();
            return $this->responseSuccess('Successfully logged out');
        } catch (TokenExpiredException $e) {
            return $this->responseError(error: 'token expired', status: Response::HTTP_UNAUTHORIZED, message: 'Unauthorized');
        } catch (TokenInvalidException $e) {
            return $this->responseError(error: 'token invalid', status: Response::HTTP_UNAUTHORIZED, message: 'Unauthorized');
        } catch (JWTException $e) {
            return $this->responseError(error: 'token absent!', status: Response::HTTP_UNAUTHORIZED, message: 'Unauthorized');
        }
    }

    /**
     * @return array
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
        ];
    }
}
