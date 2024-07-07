<?php

namespace Domain\Auth\V1\Controllers;

use App\Http\Controllers\Controller;
use Domain\Auth\V1\Actions\RegisterAction;
use Domain\Auth\V1\DTOs\RegisterData;
use Domain\Auth\V1\Requests\RegisterRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class AdminRegisterController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/admin/register",
     *      operationId="AdminRegister",
     *      tags={"Admin"},
     *
     *      @OA\RequestBody(
     *
     *          @OA\JsonContent(),
     *
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *
     *              @OA\Schema(
     *                  type="object",
     *                  required={
     *                   "email",
     *                   "first_name",
     *                   "last_name",
     *                   "password",
     *                   "password_confirmation",
     *                   "avatar",
     *                   "address",
     *                   "phone_number",
     *                   },
     *
     *                  @OA\Property(property="email",type="string"),
     *                  @OA\Property(property="first_name",type="string"),
     *                  @OA\Property(property="last_name",type="string"),
     *                  @OA\Property(property="password",type="string"),
     *                  @OA\Property(property="password_confirmation",type="string"),
     *                  @OA\Property(property="avatar",type="string"),
     *                  @OA\Property(property="address",type="string"),
     *                  @OA\Property(property="phone_number",type="string"),
     *                  @OA\Property(property="is_marketing",type="boolean"),
     *              ),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response="200",
     *          description="Admin registration successful",
     *
     *          @OA\JsonContent()
     *      ),
     *
     *      @OA\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *
     *        @OA\JsonContent()
     *      ),
     *  )
     *
     * @throws InvalidDataClass
     * @throws \Exception
     */
    public function __invoke(RegisterRequest $request): Responsable
    {
        /** @var RegisterData $data */
        $data = $request->getData();

        $user = RegisterAction::execute(registerData: $data, isAdmin: true);

        return new SuccessResponse(
            data: $user->toArray(),
        );
    }
}
