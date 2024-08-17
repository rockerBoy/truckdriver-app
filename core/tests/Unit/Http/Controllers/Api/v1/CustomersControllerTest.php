<?php

namespace Tests\Unit\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\Customers\CustomersController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Tests\TestCase;

final class CustomersControllerTest extends TestCase
{
    private CustomersController $controller;

    protected function setUp(): void
    {
        $app = $this->createApplication();
        $this->controller = $app->make(CustomersController::class);
    }

    public function test_if_index_returns_collection(): void
    {
        $result = $this->controller->index();
        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }
}
