<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/it', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/it', []);

		$response->assertStatus(200);

	}

	/**
	 * Lista
	 *
	 * @return void
	 */
	public function testListaWithError()
	{
		$response = $this->json('GET', '/it/lista/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Lista
	 *
	 * @return void
	 */
	public function testLista()
	{
		$response = $this->json('GET', '/it/lista/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Andamento
	 *
	 * @return void
	 */
	public function testAndamentoWithError()
	{
		$response = $this->json('GET', '/it/andamento/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Andamento
	 *
	 * @return void
	 */
	public function testAndamento()
	{
		$response = $this->json('GET', '/it/andamento/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Prazos
	 *
	 * @return void
	 */
	public function testPrazosWithError()
	{
		$response = $this->json('GET', '/it/prazos/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Prazos
	 *
	 * @return void
	 */
	public function testPrazos()
	{
		$response = $this->json('GET', '/it/prazos/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Rel_valores
	 *
	 * @return void
	 */
	public function testRel_valoresWithError()
	{
		$response = $this->json('GET', '/it/rel_valores/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Rel_valores
	 *
	 * @return void
	 */
	public function testRel_valores()
	{
		$response = $this->json('GET', '/it/rel_valores/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Julgamento
	 *
	 * @return void
	 */
	public function testJulgamentoWithError()
	{
		$response = $this->json('GET', '/it/julgamento/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Julgamento
	 *
	 * @return void
	 */
	public function testJulgamento()
	{
		$response = $this->json('GET', '/it/julgamento/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagadosWithError()
	{
		$response = $this->json('GET', '/it/apagados/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagados()
	{
		$response = $this->json('GET', '/it/apagados/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/it/criar', []);

		$response->assertStatus(400);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/it/criar', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/it/salvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/it/salvar', []);

		$response->assertStatus(200);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShowWithError()
	{
		$response = $this->json('GET', '/it/ver/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShow()
	{
		$response = $this->json('GET', '/it/ver/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('GET', '/it/editar/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('GET', '/it/editar/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/it/atualizar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/it/atualizar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('GET', '/it/remover/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('GET', '/it/remover/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestoreWithError()
	{
		$response = $this->json('GET', '/it/recuperar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestore()
	{
		$response = $this->json('GET', '/it/recuperar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDeleteWithError()
	{
		$response = $this->json('GET', '/it/apagar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDelete()
	{
		$response = $this->json('GET', '/it/apagar/{id}', []);

		$response->assertStatus(200);

	}

}
