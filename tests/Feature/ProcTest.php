<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcTest extends TestCase
{
	/**
	 * Dados
	 *
	 * @return void
	 */
	public function testDadosWithError()
	{
		$response = $this->json('GET', '/api/dados/proc/{proc}/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Dados
	 *
	 * @return void
	 */
	public function testDados()
	{
		$response = $this->json('GET', '/api/dados/proc/{proc}/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdateWithError()
	{
		$response = $this->json('POST', '/api/proc/update/{proc}/{id}/{campo}', []);

		$response->assertStatus(400);

	}

	/**
	 * Update
	 *
	 * @return void
	 */
	public function testUpdate()
	{
		$response = $this->json('POST', '/api/proc/update/{proc}/{id}/{campo}', []);

		$response->assertStatus(200);

	}

	/**
	 * Dadocampo
	 *
	 * @return void
	 */
	public function testDadocampoWithError()
	{
		$response = $this->json('GET', '/api/proc/dadocampo/{proc}/{id}/{campo}', []);

		$response->assertStatus(400);

	}

	/**
	 * Dadocampo
	 *
	 * @return void
	 */
	public function testDadocampo()
	{
		$response = $this->json('GET', '/api/proc/dadocampo/{proc}/{id}/{campo}', []);

		$response->assertStatus(200);

	}

}
