<?php

namespace Modules\Task\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Modules\Task\App\Http\Requests\StoreTaskRequest;
use Modules\Task\App\Http\Requests\UpdateStatusRequest;
use Modules\Task\App\Http\Requests\UpdateTaskRequest;
use Modules\Task\App\Repositories\TaskRepository;
use Modules\Task\App\resources\TaskCollection;
use Modules\Task\App\resources\TaskResource;
use Modules\Task\App\Services\TaskService;

class TaskController extends Controller
{
    private TaskService $taskService;
    private TaskRepository $taskRepository;

    /**
     * @param TaskService $taskService
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskService $taskService, TaskRepository $taskRepository)
    {
        $this->taskService = $taskService;
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TaskCollection($this->taskRepository->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): Response
    {
        $validatedData = $request->validated();

        $this->taskService->save($validatedData);

        return response([
            'message' => 'api_messages.store_task_successfully'
        ], 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $task = $this->taskRepository->findById($id);

        if (!isset($task)) {
            return response([
                'message' => 'api_messages.task_not_found'
            ]);
        }

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id): Response
    {
        $validatedData = $request->validated();

        $this->taskService->update($id, $validatedData);

        return response([
            'message' => __('api_messages.update_task_successfully'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): Response
    {
        $task = $this->taskRepository->findById($id);

        if (!isset($task)) {
            return response([
                'message' => 'api_messages.task_not_found'
            ], 404);
        }

        $this->taskRepository->delete($id);

        return response([
            'message' => __('api_messages.delete_task_successfully'),
        ], 200);
    }

    public function updateStatus(UpdateStatusRequest $request, $id): Response
    {
        $validatedData = $request->validated();
        $status = $validatedData['status'];

        if (!$this->taskService->updateStatus($id, $status)) {
            return response([
                'message' => __('api_messages.task_not_found'),
            ], 404);
        }

        return response([
            'message' => __('api_messages.update_status_successfully'),
        ], 200);

    }
}
