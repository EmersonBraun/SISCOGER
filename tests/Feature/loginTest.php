<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginTest extends TestCase
{
    public function testBaseURL()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

}
