<?php

namespace Modules\Task\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Modules\Task\App\Http\Requests\StoreTaskRequest;
use Modules\Task\App\Http\Requests\UpdateStatusRequest;
use Modules\Task\App\Http\Requests\UpdateTaskRequest;
use Modules\Task\App\Models\Task;
use Modules\Task\App\Repositories\TaskRepository;
use Modules\Task\App\resources\TaskCollection;
use Modules\Task\App\resources\TaskResource;
use Modules\Task\App\Services\TaskService;

class TaskController extends Controller
{
    private TaskService $taskService;

    private TaskRepository $taskRepository;

    public function __construct(TaskService $taskService, TaskRepository $taskRepository)
    {
        $this->taskService = $taskService;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/tasks",
     *      operationId="tasksIndex",
     *      tags={"Task"},
     *      summary="task index",
     *      description="get all tasks",
     *      security={{"passport": {}},},
     *
     *      @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(ref="#/components/schemas/TaskCollection")
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
        return new TaskCollection($this->taskRepository->paginate(20));
    }

    /**
     * @OA\Post(
     *      path="/api/v1/tasks",
     *      operationId="storeTask",
     *      tags={"Task"},
     *      summary="Store Task",
     *      description="Store Task",
     *      security={{"passport": {}},},
     *
     *     @OA\RequestBody(
     *            required=true,
     *
     *            @OA\JsonContent(ref="#/components/schemas/StoreTaskRequest")
     *        ),
     *
     *    @OA\Response(
     *    response=200,
     *    description="Success",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="message", type="string", example="api_messages.store_task_successfully"),
     *    ),
     *  ),
     * )
     */
    public function store(StoreTaskRequest $request): Response
    {
        $validatedData = $request->validated();

        $this->taskService->save($validatedData);

        return response([
            'message' => 'api_messages.store_task_successfully',
        ], 201);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/tasks/{task}",
     *      operationId="showTask",
     *      tags={"Task"},
     *      summary="show task",
     *           description="show task",
     *       security={{"passport": {}},},
     *
     *       @OA\Parameter(
     *          description="show id",
     *          in="path",
     *          name="task",
     *          required=true,
     *          example="1"
     *      ),
     *
     *      @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TaskResource")
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
        $task = $this->taskRepository->findById($id);

        if (! isset($task)) {
            return response([
                'message' => 'api_messages.task_not_found',
            ]);
        }

        return new TaskResource($task);
    }

    /**
     * @OA\Patch(
     *      path="/api/v1/tasks/{task}",
     *      operationId="updateTask",
     *      tags={"Task"},
     *      summary="update task",
     *           description="update task request api",
     *       security={{"passport": {}},},
     *
     *       @OA\Parameter(
     *          description="task id",
     *          in="path",
     *          name="task",
     *          required=true,
     *          example="1"
     *      ),
     *
     *      @OA\RequestBody(
     *           required=true,
     *
     *           @OA\JsonContent(ref="#/components/schemas/UpdateTaskRequest")
     *       ),
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
    public function update(UpdateTaskRequest $request, Task $task): Response
    {
        $validatedData = $request->validated();

        $this->taskService->update($task->id, $validatedData);

        return response([
            'message' => __('api_messages.update_task_successfully'),
        ], 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/tasks/{task}",
     *      operationId="destroyTask",
     *      tags={"Task"},
     *      summary="Delete task",
     *      description="Delete task request api",
     *       security={{"passport": {}},},
     *
     *       @OA\Parameter(
     *          description="task id",
     *          in="path",
     *          name="task",
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
     *        description="Task Not Found",
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
    public function destroy($id): Response
    {
        $task = $this->taskRepository->findById($id);

        if (! isset($task)) {
            return response([
                'message' => 'api_messages.task_not_found',
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

        if (! $this->taskService->updateStatus($id, $status)) {
            return response([
                'message' => __('api_messages.task_not_found'),
            ], 404);
        }

        return response([
            'message' => __('api_messages.update_status_successfully'),
        ], 200);

    }
}
