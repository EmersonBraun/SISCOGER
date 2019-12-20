<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RespondendoTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/respondendo', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/respondendo', []);

		$response->assertStatus(200);

	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearchWithError()
	{
		$response = $this->json('GET', '/respondendo/search', []);

		$response->assertStatus(400);

	}

	/**
	 * Search
	 *
	 * @return void
	 */
	public function testSearch()
	{
		$response = $this->json('GET', '/respondendo/search', []);

		$response->assertStatus(200);

	}

	/**
	 * Lista
	 *
	 * @return void
	 */
	public function testListaWithError()
	{
		$response = $this->json('GET', '/respondendo/lista/{proc}/{dados}', []);

		$response->assertStatus(400);

	}

	/**
	 * Lista
	 *
	 * @return void
	 */
	public function testLista()
	{
		$response = $this->json('GET', '/respondendo/lista/{proc}/{dados}', []);

		$response->assertStatus(200);

	}

	/**
	 * Relatorio
	 *
	 * @return void
	 */
	public function testRelatorioWithError()
	{
		$response = $this->json('GET', '/respondendo/relatorio/{proc}/{dados}', []);

		$response->assertStatus(400);

	}

	/**
	 * Relatorio
	 *
	 * @return void
	 */
	public function testRelatorio()
	{
		$response = $this->json('GET', '/respondendo/relatorio/{proc}/{dados}', []);

		$response->assertStatus(200);

	}

	/**
	 * Cargos
	 *
	 * @return void
	 */
	public function testCargosWithError()
	{
		$response = $this->json('GET', '/respondendo/cargos/{cargos}', []);

		$response->assertStatus(400);

	}

	/**
	 * Cargos
	 *
	 * @return void
	 */
	public function testCargos()
	{
		$response = $this->json('GET', '/respondendo/cargos/{cargos}', []);

		$response->assertStatus(200);

	}

}
