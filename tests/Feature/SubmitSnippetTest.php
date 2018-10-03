<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitSnippetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_submit_a_snippet()
    {
        $response = $this->post('/', [
            'title' => 'Example Title',
            'code' => 'echo "hello world"',
            'access' => 'public',
            'syntax' => 'php',
            'expire' => '1d',
        ]);

        $this->assertDatabaseHas('snippets', [
            'title' => 'Example Title'
        ]);

        $response->assertStatus(302);

        $this
            ->get('/')
            ->assertSee('Example Title');
    }

    /** @test */
    function test_unlisted_snippet()
    {
        $response = $this->post('/', [
            'title' => 'Unlisted snippet',
            'access' => 'unlisted',
        ]);

        $this->assertDatabaseHas('snippets', [
            'title' => 'Unlisted snippet'
        ]);

        $response->assertStatus(302);

        $this
            ->get('/')
            ->assertDontSeeText('Unlisted snippet');
    }
}
