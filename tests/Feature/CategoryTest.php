<?php


use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['accept' => 'application/json']);
    }

    /** @test */
    public function a_category_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $data = ['title' => 'title'];

        $res = $this->post('api/categories', $data);

        $category = Category::query()->first();

        $this->assertDatabaseCount('categories', 1);

        $this->assertEquals($data['title'], $category->title);

        $res->assertJson([
            'data' => [
                'id' => $category->id,
                'title' => $category->title
            ]]);
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $data = ['title' => 'title'];

        $category = Category::factory()->create();

        $res = $this->patch("/api/categories/{$category->id}", $data);

        $res->assertJson([
            'data' => [
                'title' => $data['title']
            ]
        ]);
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->assertDatabaseCount('categories', 1);

        $res = $this->delete("/api/categories/{$category->id}");

        $res->assertStatus(204);

        $this->assertDatabaseCount('categories', 0);
    }

    /** @test */
    public function categories_index_view()
    {
        $this->withoutExceptionHandling();

        $categories = Category::factory(10)->create();

        $res = $this->get('/api/categories/');

        $res->assertOk();

        $json = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category->title
            ];
        })->toArray();

        $res->assertExactJson([
            'data' => $json
        ]);
    }

    /** @test */
    public function attribute_title_is_required_in_storing_category()
    {
        $data = [
            'title' => ''
        ];

        $res = $this->post('/api/categories', $data);

        $res->assertInvalid('title');
    }

    /** @test */
    public function attribute_title_is_required_in_updating_category()
    {
        $data = [
            'title' => ''
        ];
        $category = Category::factory()->create();

        $res = $this->patch("/api/categories/{$category->id}", $data);

        $res->assertInvalid('title');
    }
}
