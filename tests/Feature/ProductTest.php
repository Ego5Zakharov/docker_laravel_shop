<?php


use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['accept' => 'application/json']);
    }

    /** @test */
    public function a_product_can_be_stored()
    {
//
    }

    /** @test */
    public function a_product_can_be_updated()
    {
//
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
//
    }

    /** @test */
    public function products_index_view()
    {
//
    }


}
