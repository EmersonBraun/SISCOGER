<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/usuario', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/usuario', []);

		$response->assertStatus(200);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreateWithError()
	{
		$response = $this->json('GET', '/usuario/criar', []);

		$response->assertStatus(400);

	}

	/**
	 * Create
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$response = $this->json('GET', '/usuario/criar', []);

		$response->assertStatus(200);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/usuario/salvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/usuario/salvar', []);

		$response->assertStatus(200);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEditWithError()
	{
		$response = $this->json('GET', '/usuario/editar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Edit
	 *
	 * @return void
	 */
	public function testEdit()
	{
		$response = $this->json('GET', '/usuario/editar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('PUT', '/usuario/atualizar/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('PUT', '/usuario/atualizar/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('GET', '/usuario/remover/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('GET', '/usuario/remover/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Block
	 *
	 * @return void
	 */
	public function testBlockWithError()
	{
		$response = $this->json('GET', '/usuario/{id}/bloquear', []);

		$response->assertStatus(400);

	}

	/**
	 * Block
	 *
	 * @return void
	 */
	public function testBlock()
	{
		$response = $this->json('GET', '/usuario/{id}/bloquear', []);

		$response->assertStatus(200);

	}

	/**
	 * Unblock
	 *
	 * @return void
	 */
	public function testUnblockWithError()
	{
		$response = $this->json('GET', '/usuario/{id}/desbloquear', []);

		$response->assertStatus(400);

	}

	/**
	 * Unblock
	 *
	 * @return void
	 */
	public function testUnblock()
	{
		$response = $this->json('GET', '/usuario/{id}/desbloquear', []);

		$response->assertStatus(200);

	}

	/**
	 * SendMail
	 *
	 * @return void
	 */
	public function testSendMailWithError()
	{
		$response = $this->json('GET', '/usuario/{id}/{resend}/reenviar', []);

		$response->assertStatus(400);

	}

	/**
	 * SendMail
	 *
	 * @return void
	 */
	public function testSendMail()
	{
		$response = $this->json('GET', '/usuario/{id}/{resend}/reenviar', []);

		$response->assertStatus(200);

	}

	/**
	 * Manual
	 *
	 * @return void
	 */
	public function testManualWithError()
	{
		$response = $this->json('GET', '/usuario/manual', []);

		$response->assertStatus(400);

	}

	/**
	 * Manual
	 *
	 * @return void
	 */
	public function testManual()
	{
		$response = $this->json('GET', '/usuario/manual', []);

		$response->assertStatus(200);

	}

}
