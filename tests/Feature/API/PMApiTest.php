<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PMApiTest extends TestCase
{
	/**
	 * Sugest
	 *
	 * @return void
	 */
	public function testSugestWithError()
	{
		$response = $this->json('POST', '/api/dados/sugest', []);

		$response->assertStatus(400);

	}

	/**
	 * Sugest
	 *
	 * @return void
	 */
	public function testSugest()
	{
		$response = $this->json('POST', '/api/dados/sugest', []);

		$response->assertStatus(200);

	}

	/**
	 * Dados
	 *
	 * @return void
	 */
	public function testDadosWithError()
	{
		$response = $this->json('GET', '/api/dados/pm/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Dados
	 *
	 * @return void
	 */
	public function testDados()
	{
		$response = $this->json('GET', '/api/dados/pm/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Cautelas
	 *
	 * @return void
	 */
	public function testCautelasWithError()
	{
		$response = $this->json('GET', '/api/dados/cautelas/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Cautelas
	 *
	 * @return void
	 */
	public function testCautelas()
	{
		$response = $this->json('GET', '/api/dados/cautelas/{rg}', []);

		$response->assertStatus(200);

	}

}
