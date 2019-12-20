<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DenunciadoTest extends TestCase
{
	/**
	 * EstaDenunciado
	 *
	 * @return void
	 */
	public function testEstaDenunciadoWithError()
	{
		$response = $this->json('GET', '/api/denuncia/estaDenunciado/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * EstaDenunciado
	 *
	 * @return void
	 */
	public function testEstaDenunciado()
	{
		$response = $this->json('GET', '/api/denuncia/estaDenunciado/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testListWithErrorAPi()
	{
		$response = $this->json('GET', '/api/denuncia/list/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testList()
	{
		$response = $this->json('GET', '/api/denuncia/list/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithErrorApi()
	{
		$response = $this->json('POST', '/api/denuncia/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreApi()
	{
		$response = $this->json('POST', '/api/denuncia/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithErrorApi()
	{
		$response = $this->json('PUT', '/api/denuncia/update/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateApi()
	{
		$response = $this->json('PUT', '/api/denuncia/update/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithErrorApi()
	{
		$response = $this->json('DELETE', '/api/denuncia/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyApi()
	{
		$response = $this->json('DELETE', '/api/denuncia/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/denunciado', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/denunciado', []);

		$response->assertStatus(200);

	}

	/**
	 * ListaDenunciados
	 *
	 * @return void
	 */
	public function testListaDenunciadosWithError()
	{
		$response = $this->json('GET', '/denunciado/denunciados', []);

		$response->assertStatus(400);

	}

	/**
	 * ListaDenunciados
	 *
	 * @return void
	 */
	public function testListaDenunciados()
	{
		$response = $this->json('GET', '/denunciado/denunciados', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/denunciado/salvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/denunciado/salvar', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/denunciado/atualizar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/denunciado/atualizar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('GET', '/denunciado/remover/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('GET', '/denunciado/remover/{id}', []);

		$response->assertStatus(200);

	}

}
