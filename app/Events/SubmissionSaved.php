<?php

namespace App\Events;

use App\Models\Submission;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubmissionSaved
{
    use Dispatchable;
    use SerializesModels;

    public Submission $submission;

    /**
     * Create a new event instance.
     */
    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }
}
