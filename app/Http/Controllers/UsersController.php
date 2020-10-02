<?php


namespace App\Http\Controllers;


use App\Http\Requests\ListUsersRequest;
use App\ParentAp\DataProviders\AllProviders;
use App\ParentAp\DataProviders\ProviderX;
use App\ParentAp\DataProviders\ProviderY;
use App\ParentAp\Enums\DataProvidersEnum;
use App\ParentAp\Services\UsersService;

class UsersController extends Controller
{
    /**
     * @var usersService
     */
    private $usersService;

    /**
     * List Users
     *
     * @param ListUsersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListUsersRequest $request)
    {
        $provider = AllProviders::class;
        if($request->provider){
            $provider = DataProvidersEnum::$classes[$request->provider];
        }
        $this->usersService = new UsersService(new $provider());
        return successResponseWithData($this->usersService->listData($request->all()));
    }

}
