<?php

namespace Modules\Letter\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Letter\App\Http\Requests\SearchLetterRequest;
use Modules\Letter\App\Http\Requests\StoreLetterRequest;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Letter\App\resources\LetterCollection;
use Modules\Letter\App\resources\LetterResource;
use Modules\Letter\App\Services\LetterService;

class LetterController extends Controller
{
    private LetterService $letterService;

    private LetterRepository $letterRepository;

    public function __construct(LetterService $letterService, LetterRepository $letterRepository)
    {
        $this->letterService = $letterService;
        $this->letterRepository = $letterRepository;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/letters",
     *      operationId="lettersIndex",
     *      tags={"Letter"},
     *      summary="letter index",
     *      description="get all letters",
     *      security={{"passport": {}},},
     *
     *      @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(ref="#/components/schemas/LetterCollection")
     *      ),
     *
     *      @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *
     *        @OA\JsonContent(ref="#/components/schemas/Unauthenticated")
     *      ),
     *     )
     */
    public function index()
    {
        return new LetterCollection($this->letterRepository->paginate(20));
    }

    /**
     * @OA\Post(
     *      path="/api/v1/letters",
     *      operationId="storeLetter",
     *      tags={"Letter"},
     *      summary="Store Letter",
     *      description="Store Letter",
     *      security={{"passport": {}},},
     *
     *     @OA\RequestBody(
     *            required=true,
     *
     *            @OA\JsonContent(ref="#/components/schemas/StoreLetterRequest")
     *        ),
     *
     *    @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="api_messages.store_letter_successfully"),
     *    ),
     *  ),
     * )
     */
    public function store(StoreLetterRequest $request): Response
    {
        $validatedData = $request->validated();

        $this->letterService->save($validatedData);

        return response([
            'message' => __('api_messages.store_letter_successfully'),
        ], 201);

    }

    /**
     * @OA\Get(
     *      path="/api/v1/letters/{letter}",
     *      operationId="showLetter",
     *      tags={"Letter"},
     *      summary="show letter",
     *           description="show letter",
     *       security={{"passport": {}},},
     *
     *       @OA\Parameter(
     *          description="show id",
     *          in="path",
     *          name="letter",
     *          required=true,
     *          example="1"
     *      ),
     *
     *      @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/LetterResource")
     *       ),
     *
     *      @OA\Response(
     *        response=404,
     *        description="error",
     *
     *        @OA\JsonContent(ref="#/components/schemas/ItemNotFound")
     *      ),
     *
     *      @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *
     *        @OA\JsonContent(ref="#/components/schemas/Unauthenticated")
     *      ),
     *     )
     */
    public function show($id)
    {
        $letter = $this->letterRepository->findById($id);

        if (! isset($letter)) {
            return response([
                'message' => 'api_messages.letter_not_found',
            ]);
        }

        return new LetterResource($letter);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/letters/{letter}",
     *      operationId="destroyLetter",
     *      tags={"Letter"},
     *      summary="Delete letter",
     *      description="Delete letter request api",
     *       security={{"passport": {}},},
     *
     *       @OA\Parameter(
     *          description="letter id",
     *          in="path",
     *          name="letter",
     *          required=true,
     *          example="1"
     *      ),
     *
     *      @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(ref="#/components/schemas/SuccessMessage")
     *      ),
     *
     *      @OA\Response(
     *        response=404,
     *        description="Letter Not Found",
     *
     *        @OA\JsonContent(ref="#/components/schemas/ItemNotFound")
     *      ),
     *
     *       @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *
     *        @OA\JsonContent(ref="#/components/schemas/Unauthenticated")
     *      ),
     *     )
     */
    public function destroy($id)
    {
        $letter = $this->letterRepository->findById($id);

        if (! isset($letter)) {
            return response([
                'message' => 'api_messages.letter_not_found',
            ], 404);
        }

        $this->letterRepository->delete($id);

        return response([
            'message' => __('api_messages.delete_letter_successfully'),
        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/letters/search",
     *      operationId="searchLetter",
     *      tags={"Letter"},
     *      summary="Search Letter",
     *      description="Search Letter",
     *      security={{"passport": {}},},
     *
     *     @OA\RequestBody(
     *            required=true,
     *
     *            @OA\JsonContent(ref="#/components/schemas/SearchLetterRequest")
     *        ),
     *
     *    @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="api_messages.store_letter_successfully"),
     *    ),
     *  ),
     * )
     */
    public function search(SearchLetterRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $articles = $this->letterService->filter($validatedData);

        return response()->json($articles);
    }
}
