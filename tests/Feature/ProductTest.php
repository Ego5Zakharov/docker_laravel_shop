<?php


use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService\Helpers\productHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, productHelper;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->withHeaders(['accept' => 'application/json']);
    }

    /** @test */
    public function test_product_can_be_stored_with_relationships()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $tags = Tag::factory(2)->create()->pluck('id')->toArray();

        $images = [
            UploadedFile::fake()->create('image_1.png', 400, 'png'),
            UploadedFile::fake()->create('image_1.png', 400, 'png'),
        ];

        $data = [
            'title' => 'title',
            'description' => 'description',
            'price' => 10000,
            'quantity' => 400,
            'is_published' => 1,
            'category_id' => $category->id,
            'tags' => $tags,
            'images' => $images
        ];

        $res = $this->post('/api/products', $data);
        $res->status(201);

        $this->assertDatabaseCount('products', 1);

        $product = Product::query()->first();

        $this->assertEquals($data['title'], $product->title);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['quantity'], $product->quantity);
        $this->assertEquals($data['is_published'], $product->is_published);
        $this->assertEquals($data['category_id'], $product->category_id);

        $this->assertCount(Image::query()->count(), $product->images);
        $this->assertCount(Tag::query()->count(), $product->tags);

        foreach ($tags as $tag) {
            $this->assertContains($tag, $product->tags->pluck('id')->toArray());
        }
    }

    /** @test */
    public function a_product_can_be_updated_with_relationships()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $tags = Tag::factory()->create();
        $images = [
            UploadedFile::fake()->create('image1.jpg', 400, 'jpg')->mimeType('image/jpg'),
            UploadedFile::fake()->create('image2.png', 1000, 'png')->mimeType('image/png'),
        ];

        $productData = [
            'title' => 'Новый заголовок',
            'description' => 'Новое описание',
            'price' => 10000,
            'quantity' => 400,
            'article' => $this->generateArticle(),
            'is_published' => true,
            'category_id' => $category->id,
            'tags' => $tags->pluck('id')->toArray(),
            'images' => $images
        ];
        $product = Product::query()->create($productData);

        $res = $this->post("/api/products/{$product->id}/update", $productData);
        $res->assertOk();

        $res->assertJson([
            'data' => [
                'id' => $product->id,
                'title' => $productData['title'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'quantity' => $productData['quantity'],
                'is_published' => $productData['is_published'],
            ],
        ]);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory()
            ->has(Category::factory())
            ->has(Tag::factory()->count(2))
            ->has(Image::factory()->count(2))
            ->create();

        $res = $this->delete("/api/products/{$product->id}");

        $this->assertDatabaseCount('products_tag', 0);
        $this->assertDatabaseCount('images', 0);

        $res->assertStatus(204);
    }

    /** @test */
    public function products_index_view()
    {
        $products = Product::factory(2)
            ->has(Category::factory())
            ->has(Image::factory()->count(2))
            ->has(Tag::factory()->count(2))
            ->create()
            ->toArray();

        $res = $this->get('/api/products/', $products);

        $res->assertOk();

        $productsCollection = collect($products);

        $json = $productsCollection->map(function ($productData) {

            $product = Product::query()->with(['category', 'tags', 'images'])->find($productData['id']);

            // Modify the structure of the expected JSON here
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'is_published' => $product->is_published,
                'article' => $product->article,
                'category' => [
                    'id' => $product->category->id,
                    'title' => $product->category->title,
                ],
                'tags' => $product->tags->map(function ($tag) {
                    return [
                        'id' => $tag->id,
                        'title' => $tag->title
                    ];
                })->toArray(),
                'images' => $product->images->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'path' => $image->path,
                        'url' => $image->url
                    ];
                })->toArray(),
            ];
        })->toArray();

        $res->assertJson([
            'data' => $json
        ]);
    }

    /** @test */
    public function products_show_view()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()
            ->has(Category::factory())
            ->has(Image::factory()->count(2))
            ->has(Tag::factory()->count(2))
            ->create();

        $res = $this->get("/api/products/{$product->id}");
        $res->assertOk();

        $json = [
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'is_published' => $product->is_published,
            'article' => $product->article,

            'category' => [
                'id' => $product->category->id,
                'title' => $product->category->title
            ],

            'images' => $product->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => $image->url,
                    'path' => $image->path,
                ];
            })->toArray(),

            'tags' => $product->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'title' => $tag->title
                ];
            })->toArray()
        ];

        $res->assertJson([
            'data' => $json
        ]);
    }
}
