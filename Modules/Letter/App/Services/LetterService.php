<?php

namespace Modules\Letter\App\Services;

use Modules\Letter\App\Jobs\SendLetterJob;
use Modules\Letter\App\Models\Letter;
use Modules\Letter\App\Repositories\LetterRepository;
use Modules\Letter\App\resources\LetterCollection;

class LetterService
{
    private LetterRepository $letterRepository;

    public function __construct(LetterRepository $letterRepository)
    {
        $this->letterRepository = $letterRepository;
    }

    public function save($data): Letter
    {

        if (isset($data['tasks'])) {
            $tasks = $data['tasks'];
            unset($data['tasks']);
        }

        $letter = $this->letterRepository->create($data);

        if (isset($tasks)) {
            $letter->tasks()->sync($tasks);

        }

        SendLetterJob::dispatch($letter);

        return $letter;
    }

    public function filter(array $data, $limit = 20): LetterCollection
    {
        $result = $this->letterRepository->filter($data);

        return new LetterCollection($result->paginate($limit));
    }
}
