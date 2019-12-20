<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TermosTest extends TestCase
{
	/**
	 * Termocriar
	 *
	 * @return void
	 */
	public function testTermocriarWithError()
	{
		$response = $this->json('GET', '/usuario/{id}/termocriar', []);

		$response->assertStatus(400);

	}

	/**
	 * Termocriar
	 *
	 * @return void
	 */
	public function testTermocriar()
	{
		$response = $this->json('GET', '/usuario/{id}/termocriar', []);

		$response->assertStatus(200);

	}

	/**
	 * Termosalvar
	 *
	 * @return void
	 */
	public function testTermosalvarWithError()
	{
		$response = $this->json('POST', '/usuario/{id}/termosalvar', []);

		$response->assertStatus(400);

	}

	/**
	 * Termosalvar
	 *
	 * @return void
	 */
	public function testTermosalvar()
	{
		$response = $this->json('POST', '/usuario/{id}/termosalvar', []);

		$response->assertStatus(200);

	}

}
