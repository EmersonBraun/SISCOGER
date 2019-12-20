<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessoTest extends TestCase
{
	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearchWithError()
	{
		$response = $this->json('GET', '/processo/busca', []);

		$response->assertStatus(400);

	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearch()
	{
		$response = $this->json('GET', '/processo/busca', []);

		$response->assertStatus(200);

	}

	/**
	 * Result
	 *
	 * @return void
	 */
	public function testResultWithError()
	{
		$response = $this->json('POST', '/processo/resultado', []);

		$response->assertStatus(400);

	}

	/**
	 * Result
	 *
	 * @return void
	 */
	public function testResult()
	{
		$response = $this->json('POST', '/processo/resultado', []);

		$response->assertStatus(200);

	}

}
