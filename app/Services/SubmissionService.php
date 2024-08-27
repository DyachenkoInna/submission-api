<?php

namespace App\Services;

use App\Models\Submission;

class SubmissionService
{
    /**
     * Process the submission.
     * Save the submission to the database.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     * @return Submission
     */
    public function create(string $name, string $email, string $message): Submission
    {
        return Submission::create([
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ]);
    }
}
