<?php

namespace Tests\Unit\Models;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use PHPUnit\Framework\Attributes\{Group, Test};
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

#[Group('model')]
#[Group('submit')]
class SubmissionModelTest extends TestCase
{
    #[Test]
    public function submission_saved_event_triggered_after_model_saved(): void
    {
        Event::fake();

        $submission = Submission::factory()->create();

        Event::assertDispatched(SubmissionSaved::class, function ($event) use ($submission) {
            return $event->submission->is($submission);
        });
    }
}
