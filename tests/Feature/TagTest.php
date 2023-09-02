<?php
//
//namespace Tests\Feature;
//
//use App\Models\Tag;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Tests\TestCase;
//
//class TagTest extends TestCase
//{
//    use RefreshDatabase;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//        $this->withHeaders(['accept' => 'application/json']);
//    }
//
//    /** @test */
//    public function a_tag_can_be_stored()
//    {
//        $this->withoutExceptionHandling();
//
//        $data = ['title' => 'title'];
//
//        $res = $this->post('api/tags', $data);
//
//        $tag = Tag::query()->first();
//
//        $this->assertDatabaseCount('tags', 1);
//
//        $this->assertEquals($data['title'], $tag->title);
//
//        $res->assertJson([
//            'data' => [
//                'id' => $tag->id,
//                'title' => $tag->title
//            ]]);
//    }
//
//    /** @test */
//    public function a_tag_can_be_updated()
//    {
//        $this->withoutExceptionHandling();
//
//        $data = ['title' => 'title'];
//
//        $tag = Tag::factory()->create();
//
//        $res = $this->patch("/api/tags/{$tag->id}", $data);
//
//        $res->assertJson([
//            'data' => [
//                'title' => $data['title']
//            ]
//        ]);
//    }
//
//    /** @test */
//    public function a_tag_can_be_deleted()
//    {
//        $this->withoutExceptionHandling();
//
//        $tag = Tag::factory()->create();
//
//        $this->assertDatabaseCount('tags', 1);
//
//        $res = $this->delete("/api/tags/{$tag->id}");
//
//        $res->assertStatus(204);
//
//        $this->assertDatabaseCount('tags', 0);
//    }
//
//    /** @test */
//    public function tags_index_view()
//    {
//        $this->withoutExceptionHandling();
//
//        $tags = Tag::factory(10)->create();
//
//        $res = $this->post('/api/tags/index', ['page' => 1]);
//
//        $res->assertOk();
//
//        $res->assertJsonStructure([
//            'data' => [],
//            'links' => [
//                'first',
//                'last',
//                'prev',
//                'next',
//            ],
//            'meta' => [
//                'current_page',
//                'from',
//                'last_page',
//                'path',
//                'per_page',
//                'to',
//                'total',
//            ],
//        ]);
//    }
//
//    /** @test */
//    public function attribute_title_is_required_in_storing_tag()
//    {
//        $data = [
//            'title' => ''
//        ];
//
//        $res = $this->post('/api/tags', $data);
//
//        $res->assertInvalid('title');
//    }
//
//    /** @test */
//    public function attribute_title_is_required_in_updating_tag()
//    {
//        $data = [
//            'title' => ''
//        ];
//        $tag = Tag::factory()->create();
//
//        $res = $this->patch("/api/tags/{$tag->id}", $data);
//
//        $res->assertInvalid('title');
//    }
//}
