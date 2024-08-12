<?php

namespace App\Http\Controllers;

use App\Dto\SubmissionDto;
use App\Http\Requests\SubmissionStoreApiRequest;
use App\Services\SubmissionService;

class SubmissionApiController extends Controller
{
    public function __construct(private readonly SubmissionService $submissionService) {}

    /**
     * @param SubmissionStoreApiRequest $request
     * @return array
     */
    public function store(SubmissionStoreApiRequest $request): array
    {
        $requestData = (object) $request->validated();

        $dto = (new SubmissionDto())
            ->setName($requestData->name)
            ->setEmail($requestData->email)
            ->setMessage($requestData->message);

        $this->submissionService->create($dto);

        return [
            'message' => 'Submission creation is added to queue.'
        ];
    }
}
