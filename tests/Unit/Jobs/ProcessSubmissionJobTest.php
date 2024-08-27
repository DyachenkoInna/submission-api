<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProcessSubmission;
use App\Models\Submission;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Attributes\{Group, Test};
use Tests\TestCase;

#[Group('job')]
#[Group('submit')]
class ProcessSubmissionJobTest extends TestCase
{
    #[Test]
    public function process_submission_job_creates_new_submission(): void
    {
        $data = Arr::only(Submission::factory()->raw(), ['name', 'email', 'message']);

        dispatch(new ProcessSubmission($data['name'], $data['email'], $data['message']));

        $this->assertDatabaseHas('submissions', $data);
    }
}
