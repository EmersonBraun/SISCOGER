<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
	/**
	 * Created
	 *
	 * @return void
	 */
	public function testCreatedWithError()
	{
		$response = $this->json('GET', '/log/criado/{name}', []);

		$response->assertStatus(400);

	}

	/**
	 * Created
	 *
	 * @return void
	 */
	public function testCreated()
	{
		$response = $this->json('GET', '/log/criado/{name}', []);

		$response->assertStatus(200);

	}

	/**
	 * Updated
	 *
	 * @return void
	 */
	public function testUpdatedWithError()
	{
		$response = $this->json('GET', '/log/atualizado/{name}', []);

		$response->assertStatus(400);

	}

	/**
	 * Updated
	 *
	 * @return void
	 */
	public function testUpdated()
	{
		$response = $this->json('GET', '/log/atualizado/{name}', []);

		$response->assertStatus(200);

	}

	/**
	 * Deleted
	 *
	 * @return void
	 */
	public function testDeletedWithError()
	{
		$response = $this->json('GET', '/log/apagado/{name}', []);

		$response->assertStatus(400);

	}

	/**
	 * Deleted
	 *
	 * @return void
	 */
	public function testDeleted()
	{
		$response = $this->json('GET', '/log/apagado/{name}', []);

		$response->assertStatus(200);

	}

	/**
	 * Restored
	 *
	 * @return void
	 */
	public function testRestoredWithError()
	{
		$response = $this->json('GET', '/log/restaurado/{name}', []);

		$response->assertStatus(400);

	}

	/**
	 * Restored
	 *
	 * @return void
	 */
	public function testRestored()
	{
		$response = $this->json('GET', '/log/restaurado/{name}', []);

		$response->assertStatus(200);

	}

}
