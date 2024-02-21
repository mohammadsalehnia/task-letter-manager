<?php

namespace Modules\Letter\App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Modules\Letter\App\Http\Requests\StoreLetterRequest;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Letter\App\resources\LetterCollection;
use Modules\Letter\App\Services\LetterService;
use Modules\Task\App\Repositories\TaskRepository;

class LetterController extends Controller
{
    private LetterService $letterService;

    private LetterRepository $letterRepository;

    private UserRepository $userRepository;

    private TaskRepository $taskRepository;

    public function __construct(LetterService $letterService,
        LetterRepository $letterRepository,
        UserRepository $userRepository,
        TaskRepository $taskRepository)
    {
        $this->letterService = $letterService;
        $this->letterRepository = $letterRepository;
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
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
    public function create()
    {
        $tasks = $this->taskRepository->all();
        $users = $this->userRepository->all();

        return view('letter::create', compact('tasks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLetterRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->letterService->save($validatedData);

        return redirect(route('panel.letters.index'))->with('success', 'Letter has been created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $letter = $this->letterRepository->findById($id);

        return view('letter::show', compact('letter'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->letterRepository->delete($id);

        return redirect(route('panel.letters.index'))->with('success', 'Letter has been deleted successfully!');

    }
}
