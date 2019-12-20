<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovimentoTest extends TestCase
{
	/**
	 * List
	 *
	 * @return void
	 */
	public function testListWithError()
	{
		$response = $this->json('GET', '/api/movimento/list/{proc}/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testList()
	{
		$response = $this->json('GET', '/api/movimento/list/{proc}/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/movimento/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/movimento/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('DELETE', '/api/movimento/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('DELETE', '/api/movimento/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserirWithError()
	{
		$response = $this->json('POST', '/movimento/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserir()
	{
		$response = $this->json('POST', '/movimento/{id}', []);

		$response->assertStatus(200);

	}

}
