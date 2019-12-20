<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CadastroOPMTest extends TestCase
{
	/**
	 * Get
	 *
	 * @return void
	 */
	public function testGetWithError()
	{
		$response = $this->json('GET', '/api/cadastroopm/get/{cdopm}', []);

		$response->assertStatus(400);

	}

	/**
	 * Get
	 *
	 * @return void
	 */
	public function testGet()
	{
		$response = $this->json('GET', '/api/cadastroopm/get/{cdopm}', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/cadastroopm/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/cadastroopm/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/api/cadastroopm/update/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/api/cadastroopm/update/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('DELETE', '/api/cadastroopm/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('DELETE', '/api/cadastroopm/destroy/{id}', []);

		$response->assertStatus(200);

	}

}
