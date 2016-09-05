<?php

use App\PHPAustralia\Docs;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DocsTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_md_static_page()
    {
        $this->get('/docs/about')
            ->see('about');
    }

    /**
     * @test
     */
    public function it_returns_404_if_doc_not_found()
    {
        $this->get('/docs/foobar')
            ->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function it_gets_list_of_all_docs()
    {
        $docs = Docs::all();

        $this->assertTrue(
            $docs->contains('CHANGELOG') &&
            $docs->contains('CONDUCT') &&
            $docs->contains('LICENCE') &&
            $docs->contains('ABOUT')
        );
    }

    /**
     * @test
     */
    public function it_gets_doc_with_any_case()
    {
        $doc = Docs::get('changelog');

        $this->assertTrue($doc != null);

        $doc2 = Docs::get('CHANGELOG');

        $this->assertTrue($doc2 != null);
    }
}
