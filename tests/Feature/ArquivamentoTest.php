<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArquivamentoTest extends TestCase
{
	/**
	 * List
	 *
	 * @return void
	 */
	public function testListWithError()
	{
		$response = $this->json('GET', '/api/arquivo/list/{proc}/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testList()
	{
		$response = $this->json('GET', '/api/arquivo/list/{proc}/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/arquivo/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/arquivo/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('POST', '/api/arquivo/edit/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('POST', '/api/arquivo/edit/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('DELETE', '/api/arquivo/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('DELETE', '/api/arquivo/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/arquivamento/criar', []);

		$response->assertStatus(400);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/arquivamento/criar', []);

		$response->assertStatus(200);

	}

	/**
	 * Save
	 *
	 * @return void
	 */
	public function testSaveWithError()
	{
		$response = $this->json('POST', '/arquivamento/salvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Save
	 *
	 * @return void
	 */
	public function testSave()
	{
		$response = $this->json('POST', '/arquivamento/salvar', []);

		$response->assertStatus(200);

	}

	/**
	 * Prateleira
	 *
	 * @return void
	 */
	public function testPrateleiraWithError()
	{
		$response = $this->json('GET', '/arquivamento/prateleira/{numero}', []);

		$response->assertStatus(400);

	}

	/**
	 * Prateleira
	 *
	 * @return void
	 */
	public function testPrateleira()
	{
		$response = $this->json('GET', '/arquivamento/prateleira/{numero}', []);

		$response->assertStatus(200);

	}

	/**
	 * Local
	 *
	 * @return void
	 */
	public function testLocalWithError()
	{
		$response = $this->json('GET', '/arquivamento/{local}', []);

		$response->assertStatus(400);

	}

	/**
	 * Local
	 *
	 * @return void
	 */
	public function testLocal()
	{
		$response = $this->json('GET', '/arquivamento/{local}', []);

		$response->assertStatus(200);

	}

}
