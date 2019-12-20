<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecursoTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/recurso', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/recurso', []);

		$response->assertStatus(200);

	}

	/**
	 * Lista
	 *
	 * @return void
	 */
	public function testListaWithError()
	{
		$response = $this->json('GET', '/recurso/lista', []);

		$response->assertStatus(400);

	}

	/**
	 * Lista
	 *
	 * @return void
	 */
	public function testLista()
	{
		$response = $this->json('GET', '/recurso/lista', []);

		$response->assertStatus(200);

	}

	/**
	 * Proc
	 *
	 * @return void
	 */
	public function testProcWithError()
	{
		$response = $this->json('GET', '/recurso/proc/{proc}', []);

		$response->assertStatus(400);

	}

	/**
	 * Proc
	 *
	 * @return void
	 */
	public function testProc()
	{
		$response = $this->json('GET', '/recurso/proc/{proc}', []);

		$response->assertStatus(200);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagadosWithError()
	{
		$response = $this->json('GET', '/recurso/apagados', []);

		$response->assertStatus(400);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagados()
	{
		$response = $this->json('GET', '/recurso/apagados', []);

		$response->assertStatus(200);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/recurso/criar', []);

		$response->assertStatus(400);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/recurso/criar', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/recurso/salvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/recurso/salvar', []);

		$response->assertStatus(200);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShowWithError()
	{
		$response = $this->json('GET', '/recurso/ver/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShow()
	{
		$response = $this->json('GET', '/recurso/ver/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('GET', '/recurso/editar/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('GET', '/recurso/editar/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/recurso/atualizar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/recurso/atualizar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('GET', '/recurso/remover/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('GET', '/recurso/remover/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestoreWithError()
	{
		$response = $this->json('GET', '/recurso/recuperar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestore()
	{
		$response = $this->json('GET', '/recurso/recuperar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDeleteWithError()
	{
		$response = $this->json('GET', '/recurso/apagar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDelete()
	{
		$response = $this->json('GET', '/recurso/apagar/{id}', []);

		$response->assertStatus(200);

	}

}
