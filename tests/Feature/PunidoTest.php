<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PunidoTest extends TestCase
{
	/**
	 * List
	 *
	 * @return void
	 */
	public function testListWithError()
	{
		$response = $this->json('GET', '/api/punicao/list/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testList()
	{
		$response = $this->json('GET', '/api/punicao/list/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * StoreAPI
	 *
	 * @return void
	 */
	public function testStoreAPIWithError()
	{
		$response = $this->json('POST', '/api/punicao/store', []);

		$response->assertStatus(400);

	}

	/**
	 * StoreAPI
	 *
	 * @return void
	 */
	public function testStoreAPI()
	{
		$response = $this->json('POST', '/api/punicao/store', []);

		$response->assertStatus(200);

	}

	/**
	 * UpdateAPI
	 *
	 * @return void
	 */
	public function testUpdateAPIWithError()
	{
		$response = $this->json('PUT', '/api/punicao/update/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * UpdateAPI
	 *
	 * @return void
	 */
	public function testUpdateAPI()
	{
		$response = $this->json('PUT', '/api/punicao/update/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * DestroyAPI
	 *
	 * @return void
	 */
	public function testDestroyAPIWithError()
	{
		$response = $this->json('DELETE', '/api/punicao/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * DestroyAPI
	 *
	 * @return void
	 */
	public function testDestroyAPI()
	{
		$response = $this->json('DELETE', '/api/punicao/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Conselho
	 *
	 * @return void
	 */
	public function testConselhoWithError()
	{
		$response = $this->json('GET', '/punido/conselho', []);

		$response->assertStatus(400);

	}

	/**
	 * Conselho
	 *
	 * @return void
	 */
	public function testConselho()
	{
		$response = $this->json('GET', '/punido/conselho', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/punido/{proc}', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/punido/{proc}', []);

		$response->assertStatus(200);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/punido/criar', []);

		$response->assertStatus(400);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/punido/criar', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/punido/salvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/punido/salvar', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('GET', '/punido/editar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('GET', '/punido/editar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/punido/atualizar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/punido/atualizar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('GET', '/punido/remover/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('GET', '/punido/remover/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestoreWithError()
	{
		$response = $this->json('GET', '/punido/recuperar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestore()
	{
		$response = $this->json('GET', '/punido/recuperar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDeleteWithError()
	{
		$response = $this->json('GET', '/punido/apagar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDelete()
	{
		$response = $this->json('GET', '/punido/apagar/{id}', []);

		$response->assertStatus(200);

	}

}
