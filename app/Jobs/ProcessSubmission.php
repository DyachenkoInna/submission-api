<?php

namespace App\Jobs;

use App\Services\SubmissionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessSubmission implements ShouldQueue
{
    use Queueable;

    public string $name;
    public string $email;
    public string $message;

    /**
     * Create a new job instance.
     */
    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app(SubmissionService::class)->create($this->name, $this->email, $this->message);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Log::error('Failed to process submission', [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'exception' => $exception,
        ]);
    }
}
