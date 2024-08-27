<?php

namespace Tests\Unit\Listeners;

use App\Models\Submission;
use PHPUnit\Framework\Attributes\{Group, Test};
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

#[Group('listener')]
#[Group('submit')]
class LogSubmissionSavedListenerTest extends TestCase
{
    #[Test]
    public function submission_saved_event_logged(): void
    {
        $submission = Submission::factory()->make();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) use ($submission) {
                return $message === 'Submission saved'
                    && $context['name'] === $submission->name
                    && $context['email'] === $submission->email;
            });

        $submission->save();
    }
}
