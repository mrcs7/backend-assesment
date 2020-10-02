<?php


namespace Tests\Feature;


use Tests\TestCase;

class ListUsersTest extends TestCase
{
    /** @test */
    public function list_users_from_all_providers()
    {
        $response = $this->get('/api/v1/users');
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'message' => null,
            ]
        );
    }

    /** @test */
    public function list_users_from_one_provider()
    {
        $response = $this->get('/api/v1/users?provider=DataProviderX');
        $response->assertStatus(200);
        $response->assertJson(
            [
                'status' => 'success',
                'message' => null,
            ]
        );
    }

    /** @test */
    public function validation_error_if_given_provider_does_not_exists()
    {
        $response = $this->get('/api/v1/users?provider=DataProviderABC');
        $response->assertStatus(422);
        $response->assertJson(
            [
                'status' => 'validations',
                'errors' => ["The selected provider is invalid."],
            ]
        );
    }

}
