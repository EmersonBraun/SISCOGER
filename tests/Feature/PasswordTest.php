<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordTest extends TestCase
{
	/**
	 * Passedit
	 *
	 * @return void
	 */
	public function testPasseditWithError()
	{
		$response = $this->json('GET', '/usuario/{id}/senha', []);

		$response->assertStatus(400);

	}

	/**
	 * Passedit
	 *
	 * @return void
	 */
	public function testPassedit()
	{
		$response = $this->json('GET', '/usuario/{id}/senha', []);

		$response->assertStatus(200);

	}

	/**
	 * Passupdate
	 *
	 * @return void
	 */
	public function testPassupdateWithError()
	{
		$response = $this->json('PUT', '/usuario/{id}/senhaatualizar', []);

		$response->assertStatus(400);

	}

	/**
	 * Passupdate
	 *
	 * @return void
	 */
	public function testPassupdate()
	{
		$response = $this->json('PUT', '/usuario/{id}/senhaatualizar', []);

		$response->assertStatus(200);

	}

}
