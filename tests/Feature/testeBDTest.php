<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class testeBDTest extends TestCase
{
	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearchWithError()
	{
		$response = $this->json('GET', '/bd/{nome}', []);

		$response->assertStatus(400);

	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearch()
	{
		$response = $this->json('GET', '/bd/{nome}', []);

		$response->assertStatus(200);

	}

	/**
	 * Qtds
	 *
	 * @return void
	 */
	public function testQtdsWithError()
	{
		$response = $this->json('GET', '/bd/qtds', []);

		$response->assertStatus(400);

	}

	/**
	 * Qtds
	 *
	 * @return void
	 */
	public function testQtds()
	{
		$response = $this->json('GET', '/bd/qtds', []);

		$response->assertStatus(200);

	}

}
