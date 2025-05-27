<?php

namespace Tests\Feature;

use Tests\TestCase;

class SentryErrorTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_bug_simples(): void
    {
        $response = $this->get('/bug-simples');

        $response->assertStatus(500);
    }

    public function test_bug_array(): void
    {
        $response = $this->get('/bug-array');

        $response->assertStatus(500);
    }

    public function test_bug_loop(): void
    {
        $this->expectException(\Illuminate\Http\Client\RequestException::class);

        $this->get('/bug-loop');
    }

    public function test_bug_tipo(): void
    {
        $response = $this->get('/bug-tipo');

        $response->assertStatus(500);
    }
}
