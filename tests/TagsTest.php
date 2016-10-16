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

    public function indexTest()
    {
        $tags = factory(App\Tag::class, 2)->create();

        $this->actingAs($this->admin)
            ->visit('/admin/tags')
            ->see($tags[0]->name)
            ->see($tags[1]->name);
    }

    public function showTest()
    {
        $tag = factory(App\Tag::class)->create();
        $this->actingAs($this->admin)
            ->visit('/admin/tags/'.$tag->id)
            ->see($tag->name);
    }

    public function createTest()
    {
        $name = $this->faker->word;

        $description = $this->faker->sentence();

        $this->visit('/admin/tags/create')
            ->type($name, 'name')
            ->type($description, 'description')
            ->press('create')
            ->seeInDatabase('tags', ['name' => $name, 'description' => $description]);
    }

    public function editTest()
    {
        $tag = factory(App\Tag::class)->create();

        $name = $this->faker->word;

        $this->actingAs($this->admin)
            ->visit("/admin/tags/$tag->id/edit")
            ->type($name, 'name')
            ->press('update')
            ->seeInDatabase('tags', ['id' => $tag->id, 'name' => $name]);
    }

    public function deleteTest()
    {
        $tag = factory(App\Tag::class)->create();

        $response = $this->call('DELETE', "/admin/tags/$tag->id");

        $this->assertEquals(200, $response->getStatusCode());

        $this->dontSeeInDatabase('tags', ['id' => $tag->id]);
    }

    public function APIIndexTest()
    {
        $tags = factory(App\Tag::class, 3)->create();

        $this->json('GET', "/api/v1/tags")
            ->seeJson([
                'data' => [
                    [
                        'name' => $tags[0]->name
                    ],
                    [
                        'name' => $tags[1]->name
                    ],
                    [
                        'name' => $tags[2]->name
                    ],
                ]
            ]);
    }

    public function APISearchTest()
    {
        $tags = factory(App\Tag::class, 3)->create();

        $this->json('GET', "/api/v1/tags?q={$tags[0]->name}")
            ->seeJson([
                'data' => [
                    [
                        'name' => $tags[0]->name
                    ]
                ]
            ])
            ->dontSeeJson([
                'data' => [
                    [
                        'name' => $tags[1]->name
                    ],
                    [
                        'name' => $tags[2]->name
                    ],
                ]
            ]);
    }
}
