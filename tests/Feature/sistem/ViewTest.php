<?php

namespace Tests\Feature\sistem;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTest extends TestCase
{
	/**
	 * Add
	 *
	 * @return void
	 */
	public function testAddWithError()
	{
		$response = $this->json('POST', '/ajax/add/form', []);

		$response->assertStatus(400);

	}

	/**
	 * Add
	 *
	 * @return void
	 */
	public function testAdd()
	{
		$response = $this->json('POST', '/ajax/add/form', []);

		$response->assertStatus(200);

	}

}
