<?php

namespace Modules\Letter\App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Letter\App\Models\Letter;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Letter\App\resources\LetterCollection;
use Modules\Letter\App\Services\LetterService;
use Modules\Task\App\Repositories\TaskRepository;

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
        $letters = new LetterCollection($this->letterRepository->paginate(10));

        return view('letter::index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TaskRepository $taskRepository)
    {
        $tasks = $taskRepository->all();

        return view('letter::create', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('letter::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('letter::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
