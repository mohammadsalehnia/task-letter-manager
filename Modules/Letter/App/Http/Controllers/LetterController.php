<?php

namespace Modules\Letter\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Letter\App\Http\Requests\StoreLetterRequest;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Letter\App\resources\LetterCollection;
use Modules\Letter\App\resources\LetterResource;
use Modules\Letter\App\Services\LetterService;

class LetterController extends Controller
{
    private LetterService $letterService;
    private LetterRepository $letterRepository;

    /**
     * @param LetterService $letterService
     * @param LetterRepository $letterRepository
     */
    public function __construct(LetterService $letterService, LetterRepository $letterRepository)
    {
        $this->letterService = $letterService;
        $this->letterRepository = $letterRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LetterCollection($this->letterRepository->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLetterRequest $request): Response
    {
        $validatedData = $request->validated();

        $letter = $this->letterService->save($validatedData);

        return response([
            'message' => __('api_messages.store_letter_successfully')
        ], 201);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $letter = $this->letterRepository->findById($id);

        if (!isset($letter)) {
            return response([
                'message' => 'api_messages.letter_not_found'
            ]);
        }

        return new LetterResource($letter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = $this->letterRepository->findById($id);

        if (!isset($task)) {
            return response([
                'message' => 'api_messages.letter_not_found'
            ], 404);
        }

        $this->letterRepository->delete($id);

        return response([
            'message' => __('api_messages.delete_letter_successfully'),
        ], 200);
    }
}
