<?php

namespace Tests\Feature\Request;

use App\Models\Submission;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\{DataProvider, Group, Test};
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

#[Group('request')]
#[Group('submit')]
class SubmitRequestTest extends TestCase
{
    #[Test]
    #[DataProvider('requestData')]
    public function email_is_required($submission): void
    {
        $this->postJson(route('submit'), Arr::except($submission(), 'email'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['email' => 'The email field is required.']);
    }

    #[Test]
    #[DataProvider('requestData')]
    public function name_is_required($submission): void
    {
        $this->postJson(route('submit'), Arr::except($submission(), 'name'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name' => 'The name field is required.']);
    }

    #[Test]
    #[DataProvider('requestData')]
    public function message_is_required($submission): void
    {
        $this->postJson(route('submit'),  Arr::except($submission(), 'message'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['message' => 'The message field is required.']);
    }

    #[Test]
    #[DataProvider('requestData')]
    public function email_must_be_valid_email($submission): void
    {
        $data = $submission();
        $data['email'] = 'invalid-email';

        $this->postJson(route('submit'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['email' => 'The email field must be a valid email address.']);
    }

    #[Test]
    #[DataProvider('requestData')]
    public function name_must_be_less_than_255_chars($submission): void
    {
        $data = $submission();
        $data['name'] = Str::random(256);

        $this->postJson(route('submit'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name' => 'The name field must not be greater than 255 characters.']);
    }

    /**
     * Data provider for submit request data.
     * - used closure because of this - https://laravel-news.com/eloquent-factories-with-phpunit-data-providers
     *
     * @return array
     */
    public static function requestData(): array
    {
        return [
            [fn(): array => Submission::factory()->raw()],
        ];
    }
}
