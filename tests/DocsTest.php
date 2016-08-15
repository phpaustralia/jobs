<?php

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
}
