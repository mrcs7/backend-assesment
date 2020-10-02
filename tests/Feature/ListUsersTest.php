<?php


namespace Tests\Feature;


use App\ParentAp\DataProviders\AllProviders;
use App\ParentAp\DataProviders\ProviderX;
use App\ParentAp\Services\UsersService;
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

    /** @test */
    public function list_users_with_filters()
    {
        $response = $this->get('api/v1/users?provider=DataProviderX&status=authorised&balanceMin=200');
        $response->assertStatus(200);
        $responseData = json_decode($response->getContent(),true);
        $userService = new UsersService(new ProviderX());
        $filteredData = $userService->listData(['status'=>'authorised','balanceMin'=>200]);
        $this->assertEquals(count($responseData['data']),count($filteredData));
    }

    /** @test */
    public function list_users_from_all_providers_with_filters()
    {
        $response = $this->get('api/v1/users?status=authorised&balanceMin=200');
        $response->assertStatus(200);
        $responseData = json_decode($response->getContent(),true);
        $userService = new UsersService(new AllProviders());
        $filteredData = $userService->listData(['status'=>'authorised','balanceMin'=>200]);
        $this->assertEquals(count($responseData['data']),count($filteredData));
    }

}
