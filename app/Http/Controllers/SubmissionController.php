<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitRequest;
use App\Jobs\ProcessSubmission;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    /**
     * @param SubmitRequest $request
     * @return JsonResponse
     */
    public function submit(SubmitRequest $request): JsonResponse
    {
        ProcessSubmission::dispatch(
            $request->name,
            $request->email,
            $request->message
        );

        return response()->json([
            'status' => 'Accepted',
        ]);
    }
}
