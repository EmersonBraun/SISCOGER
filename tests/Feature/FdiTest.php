<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FdiTest extends TestCase
{
	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShowWithError()
	{
		$response = $this->json('GET', '/fdi/{rg}/ver', []);

		$response->assertStatus(400);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShow()
	{
		$response = $this->json('GET', '/fdi/{rg}/ver', []);

		$response->assertStatus(200);

	}

}
