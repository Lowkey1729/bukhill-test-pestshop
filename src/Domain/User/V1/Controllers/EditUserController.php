<?php

namespace Domain\User\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Domain\Admin\V1\Actions\EditUserAction;
use Domain\Admin\V1\DTOs\EditUserData;
use Domain\Admin\V1\Exceptions\EditUserException;
use Domain\User\V1\Requests\EditUserRequest;
use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Exceptions\InvalidDataClass;
use Support\Responses\V1\SuccessResponse;

class EditUserController extends Controller
{
    /**
     * @OA\Put(
     *        path="/api/v1/user/edit",
     *        operationId="UserEdit",
     *        tags={"User"},
     *        security={{"bearerAuth":{}}},
     *
     *        @OA\RequestBody(
     *
     *            @OA\JsonContent(),
     *
     *            @OA\MediaType(
     *                mediaType="multipart/form-data",
     *
     *                @OA\Schema(
     *                    type="object",
     *                    required={},
     *
     *                    @OA\Property(property="email",type="string"),
     *                    @OA\Property(property="first_name",type="string"),
     *                    @OA\Property(property="last_name",type="string"),
     *                    @OA\Property(property="password",type="string"),
     *                    @OA\Property(property="password_confirmation",type="string"),
     *                    @OA\Property(property="avatar",type="string"),
     *                    @OA\Property(property="address",type="string"),
     *                    @OA\Property(property="phone_number",type="string"),
     *                    @OA\Property(property="is_marketing",type="boolean"),
     *                ),
     *            ),
     *        ),
     *
     *        @OA\Response(
     *            response="200",
     *            description="Admin uder data edited successfully",
     *
     *            @OA\JsonContent()
     *        ),
     *
     *        @OA\Response(
     *           response="422",
     *           description="Unprocessable Entity",
     *
     *          @OA\JsonContent()
     *        ),
     *    )
     *
     * @throws InvalidDataClass
     * @throws EditUserException
     */
    public function __invoke(EditUserRequest $request): Responsable
    {

        /** @var EditUserData $data */
        $data = $request->getData();

        /** @var User $user */
        $user = $request->user();

        $result = EditUserAction::execute($data, $user->uuid);

        return new SuccessResponse(
            data: $result->toArray()
        );
    }
}
