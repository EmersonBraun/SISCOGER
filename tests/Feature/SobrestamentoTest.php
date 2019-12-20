<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SobrestamentoTest extends TestCase
{
	/**
	 * List
	 *
	 * @return void
	 */
	public function testListWithError()
	{
		$response = $this->json('GET', '/api/sobrestamento/list/{proc}/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testList()
	{
		$response = $this->json('GET', '/api/sobrestamento/list/{proc}/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/sobrestamento/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/sobrestamento/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('POST', '/api/sobrestamento/edit/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('POST', '/api/sobrestamento/edit/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('DELETE', '/api/sobrestamento/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('DELETE', '/api/sobrestamento/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserirWithError()
	{
		$response = $this->json('POST', '/sobrestamento/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserir()
	{
		$response = $this->json('POST', '/sobrestamento/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/relatorio/sobrestamento/{proc}', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/relatorio/sobrestamento/{proc}', []);

		$response->assertStatus(200);

	}

}
