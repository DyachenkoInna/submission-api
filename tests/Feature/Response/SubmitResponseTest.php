<?php

namespace Tests\Feature\Response;

use App\Models\Submission;
use PHPUnit\Framework\Attributes\{Group, Test};
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

#[Group('response')]
#[Group('submit')]
class SubmitResponseTest extends TestCase
{
    #[Test]
    public function submit_response_is_ok(): void
    {
        $this->postJson(route('submit'), Submission::factory()->raw())
            ->assertOk();
    }

    #[Test]
    public function submit_response_has_status_field(): void
    {
        $this->postJson(route('submit'), Submission::factory()->raw())
            ->assertJsonStructure(['status']);
    }

    #[Test]
    public function response_is_to_many_requests_if_request_from_same_email_sent_more_than_10_times_in_minute(): void
    {
        $requestCount = 11;
        $data = Submission::factory()->raw();
        while ($requestCount--) {
            $response = $this->postJson(route('submit'), $data);
        }

        $response->assertStatus(Response::HTTP_TOO_MANY_REQUESTS);
    }
}
