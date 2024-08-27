<?php

namespace Tests\Feature\Action;

use App\Jobs\ProcessSubmission;
use App\Models\Submission;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\{Group, Test};
use Tests\TestCase;

#[Group('action')]
#[Group('submit')]
class SubmitActionTest extends TestCase
{
    #[Test]
    public function submit_endpoint_dispatch_process_submission_job(): void
    {
        Queue::fake();

        $data = Submission::factory()->raw();
        $this->postJson(route('submit'), $data);

        Queue::assertPushed(function (ProcessSubmission $job) use ($data) {
            return $job->name === $data['name']
                && $job->email === $data['email']
                && $job->message === $data['message'];
        });
    }
}
