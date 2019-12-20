<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Test extends TestCase
{
	/**
	 * Losure
	 *
	 * @return void
	 */
	public function testLosureWithError()
	{
		$response = $this->json('GET', '/', []);

		$response->assertStatus(400);

	}

	/**
	 * Losure
	 *
	 * @return void
	 */
	public function testLosure()
	{
		$response = $this->json('GET', '/', []);

		$response->assertStatus(200);

	}

}
