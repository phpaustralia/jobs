<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsTest extends TestCase
{
    use Illuminate\Foundation\Testing\DatabaseTransactions;

    private $admin;

    public function setUp()
    {
        parent::setUp();

        $this->admin = $this->createAdmin();

        $this->faker = Faker\Factory::create();
    }

    public function testIndex()
    {
        $tags = factory(App\Tag::class, 2)->create();

        $this->actingAs($this->admin)
            ->visit('/admin/tags')
            ->see($tags[0]->name)
            ->see($tags[1]->name);
    }

    public function testShow()
    {
        $tag = factory(App\Tag::class)->create();
        $this->actingAs($this->admin)
            ->visit('/admin/tags/'.$tag->id)
            ->see($tag->name);
    }

    public function testCreate()
    {
        $name = $this->faker->word;

        $description = $this->faker->sentence();

        $this->actingAs($this->admin)
            ->visit('/admin/tags/create')
            ->type($name, 'name')
            ->type($description, 'description')
            ->press('Create')
            ->seeInDatabase('tags', ['name' => $name, 'description' => $description]);
    }

    public function testEdit()
    {
        $tag = factory(App\Tag::class)->create();

        $name = $this->faker->word;

        $description = $this->faker->sentence;

        $this->actingAs($this->admin)
            ->visit("/admin/tags/$tag->id/edit")
            ->type($name, 'name')
            ->type($description, 'description')
            ->press('update')
            ->seeInDatabase('tags', ['id' => $tag->id, 'name' => $name, 'description' => $description]);
    }

    public function testDelete()
    {
        $tag = factory(App\Tag::class)->create();

        $response = $this->actingAs($this->admin)
            ->call('DELETE', "/admin/tags/$tag->id");

        $this->assertRedirectedTo("/admin/tags");

        $this->dontSeeInDatabase('tags', ['id' => $tag->id]);
    }

    public function testAPIIndex()
    {
        $tags = factory(App\Tag::class, 3)->create();

        $this->json('GET', "/api/v1/tags")
            ->seeJson([
                'data' => [
                    $tags[0]->toArray(),
                    $tags[1]->toArray(),
                     $tags[2]->toArray()
                ]
            ]);
    }

    public function testAPISearch()
    {
        $tags = factory(App\Tag::class, 3)->create();

        $this->json('GET', "/api/v1/tags?q={$tags[0]->name}")
            ->seeJson([
                'data' => [
                    $tags[0]->toArray()
                ]
            ])
            ->dontSeeJson([
                'data' => [
                    $tags[1]->toArray(),
                    $tags[2]->toArray()
                ]
            ]);
    }
}
