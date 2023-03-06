<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_route_for_all_posts()
    {
        $response = $this->get('/api/v1/posts/all');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_has_a_correct_structure()
    {
        $response = $this->get('/api/v1/posts/all');

        $response->assertJsonStructure([
            '*' => [
                'id',
                'user_id',
                'user_name',
                'body',
                'created_at',
                'updated_at',
            ]
        ]);

    }

    /** @test */
    public function it_shows_all_posts()
    {
        $posts = Post::factory(2)->create();

        $response = $this->get('/api/v1/posts/all');

        $response->assertJsonCount(2);

        $response->assertSee($posts[0]->body);
        $response->assertSee($posts[1]->body);
    }

    /** @test */
    public function it_shows_a_single_post()
    {
        $post = Post::factory()->create();

        $response = $this->get('/api/v1/posts/' . $post->id);

        $response->assertStatus(200);

        $response->assertSee($post->body);
    }

    /** @test */
    public function it_includes_the_user_name()
    {
        $post = Post::factory()->create();

        $response = $this->get('/api/v1/posts/' . $post->id);

        $response->assertStatus(200);

        $response->assertSee($post->user->name);
    }

    /** @test */
    public function an_authenticated_user_can_add_a_post()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/v1/posts', [
            'body' => 'This is a test post'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('posts', [
            'body' => 'This is a test post'
        ]);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_add_a_post()
    {
        $response = $this->post('/api/v1/posts', [
            'body' => 'This is a test post'
        ]);

        $response->assertStatus(401);
    }


}
