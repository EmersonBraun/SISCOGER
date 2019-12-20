<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApresentacaoTest extends TestCase
{
	/**
	 * ListNota
	 *
	 * @return void
	 */
	public function testListNotaWithError()
	{
		$response = $this->json('GET', '/api/apresentacao/listnota/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * ListNota
	 *
	 * @return void
	 */
	public function testListNota()
	{
		$response = $this->json('GET', '/api/apresentacao/listnota/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Memorando_generate
	 *
	 * @return void
	 */
	public function testMemorando_generateWithError()
	{
		$response = $this->json('GET', '/api/apresentacao/memorandogerar/{id}/{nome}/{funcao}', []);

		$response->assertStatus(400);

	}

	/**
	 * Memorando_generate
	 *
	 * @return void
	 */
	public function testMemorando_generate()
	{
		$response = $this->json('GET', '/api/apresentacao/memorandogerar/{id}/{nome}/{funcao}', []);

		$response->assertStatus(200);

	}

	/**
	 * GetApresentacao
	 *
	 * @return void
	 */
	public function testGetApresentacaoWithError()
	{
		$response = $this->json('GET', '/api/apresentacao/memorando/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * GetApresentacao
	 *
	 * @return void
	 */
	public function testGetApresentacao()
	{
		$response = $this->json('GET', '/api/apresentacao/memorando/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/apresentacao/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/apresentacao/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/api/apresentacao/update/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/api/apresentacao/update/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * DestroyApi
	 *
	 * @return void
	 */
	public function testDestroyApiWithError()
	{
		$response = $this->json('DELETE', '/api/apresentacao/destroyApi/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * DestroyApi
	 *
	 * @return void
	 */
	public function testDestroyApi()
	{
		$response = $this->json('DELETE', '/api/apresentacao/destroyApi/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * DadosApresentacao
	 *
	 * @return void
	 */
	public function testDadosApresentacaoWithError()
	{
		$response = $this->json('GET', '/api/apresentacao/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * DadosApresentacao
	 *
	 * @return void
	 */
	public function testDadosApresentacao()
	{
		$response = $this->json('GET', '/api/apresentacao/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagadosWithError()
	{
		$response = $this->json('GET', '/apresentacao/apagados/{ano}/{cdopm}', []);

		$response->assertStatus(400);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagados()
	{
		$response = $this->json('GET', '/apresentacao/apagados/{ano}/{cdopm}', []);

		$response->assertStatus(200);

	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearchWithError()
	{
		$response = $this->json('POST', '/apresentacao', []);

		$response->assertStatus(400);

	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearch()
	{
		$response = $this->json('POST', '/apresentacao', []);

		$response->assertStatus(200);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/apresentacao/criar', []);

		$response->assertStatus(400);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/apresentacao/criar', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('GET', '/apresentacao/editar/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('GET', '/apresentacao/editar/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Memorando
	 *
	 * @return void
	 */
	public function testMemorandoWithError()
	{
		$response = $this->json('GET', '/apresentacao/memorando/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Memorando
	 *
	 * @return void
	 */
	public function testMemorando()
	{
		$response = $this->json('GET', '/apresentacao/memorando/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/apresentacao/list/{ano}/{cdopm}', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/apresentacao/list/{ano}/{cdopm}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('GET', '/apresentacao/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('GET', '/apresentacao/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestoreWithError()
	{
		$response = $this->json('GET', '/apresentacao/restore/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Restore
	 *
	 * @return void
	 */
	public function testRestore()
	{
		$response = $this->json('GET', '/apresentacao/restore/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDeleteWithError()
	{
		$response = $this->json('GET', '/apresentacao/forceDelete/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * ForceDelete
	 *
	 * @return void
	 */
	public function testForceDelete()
	{
		$response = $this->json('GET', '/apresentacao/forceDelete/{id}', []);

		$response->assertStatus(200);

	}

}
