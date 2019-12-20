<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PMTest extends TestCase
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
	 * ShowSugest
	 *
	 * @return void
	 */
	public function testShowSugestWithError()
	{
		$response = $this->json('GET', '/api/dados/showsugest/{type}/{data}', []);

		$response->assertStatus(400);

	}

	/**
	 * ShowSugest
	 *
	 * @return void
	 */
	public function testShowSugest()
	{
		$response = $this->json('GET', '/api/dados/showsugest/{type}/{data}', []);

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

}
