<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnvolvidoApiTest extends TestCase
{
	/**
	 * List
	 *
	 * @return void
	 */
	public function testListWithError()
	{
		$response = $this->json('GET', '/api/dados/envolvido/{proc}/{id}/{situacao}', []);

		$response->assertStatus(400);

	}

	/**
	 * List
	 *
	 * @return void
	 */
	public function testList()
	{
		$response = $this->json('GET', '/api/dados/envolvido/{proc}/{id}/{situacao}', []);

		$response->assertStatus(200);

	}

	/**
	 * Membros
	 *
	 * @return void
	 */
	public function testMembrosWithError()
	{
		$response = $this->json('GET', '/api/dados/membros/{proc}/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Membros
	 *
	 * @return void
	 */
	public function testMembros()
	{
		$response = $this->json('GET', '/api/dados/membros/{proc}/{id}', []);

		$response->assertStatus(200);

	}

}
