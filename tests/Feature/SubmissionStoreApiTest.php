<?php

namespace Tests\Feature;

 use App\Models\Submission;
 use Illuminate\Foundation\Testing\RefreshDatabase;
 use Illuminate\Support\Str;
 use Tests\TestCase;

class SubmissionStoreApiTest extends TestCase
{
    use RefreshDatabase;

    public function testSubmissionCanBeCreated(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $this->postJson(route('api.submission.store'), $data)
            ->assertSuccessful()
            ->assertJsonFragment([
                'message' => 'Submission creation is added to queue.'
            ]);

        // for test in order to assert that submissions can be created we run test in SYNC mode.
        $this->assertDatabaseHas('submissions', $data);
    }

    public function testSubmissionNameRequired(): void
    {
        $this->postJson(route('api.submission.store'),
            [
                'email' => 'john.doe@example.com',
                'message' => 'This is a test message.',
            ]
        )->assertUnprocessable();
    }

    public function testSubmissionNameCannotBeMoreLongerThen255Letters(): void
    {
        $this->postJson(route('api.submission.store'),
            [
                'name' => Str::random(256),
                'email' => 'john.doe@example.com',
                'message' => 'This is a test message.',
            ]
        )->assertUnprocessable();
    }

    public function testSubmissionEmailIsRequired(): void
    {
        $this->postJson(route('api.submission.store'),
            [
                'name' => Str::random(),
                'message' => 'This is a test message.',
            ]
        )->assertUnprocessable();
    }

    public function testSubmissionEmailCannotBeDummy(): void
    {
        $this->postJson(route('api.submission.store'),
            [
                'name' => Str::random(),
                'email' => 'dummy',
                'message' => 'This is a test message.',
            ]
        )->assertUnprocessable();
    }

    public function testSubmissionEmailMustBeUnique(): void
    {
        $email = 'john.doe@example.com';

        Submission::factory()->create([
            'name' => 'John Doe',
            'email' => $email,
            'message' => Str::random(),
        ]);

        $this->postJson(route('api.submission.store'),
            [
                'name' => Str::random(),
                'email' => $email,
                'message' => 'This is a test message.',
            ]
        )->assertUnprocessable();
    }

    public function testSubmissionMessageIsRequired(): void
    {
        $this->postJson(route('api.submission.store'),
            [
                'name' => Str::random(),
                'email' => 'john.doe@example.com',
            ]
        )->assertUnprocessable();
    }
}
