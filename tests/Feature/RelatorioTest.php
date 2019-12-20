<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelatorioTest extends TestCase
{
	/**
	 * SearchEncarregado
	 *
	 * @return void
	 */
	public function testSearchEncarregadoWithError()
	{
		$response = $this->json('GET', '/relatorio/encarregado/busca', []);

		$response->assertStatus(400);

	}

	/**
	 * SearchEncarregado
	 *
	 * @return void
	 */
	public function testSearchEncarregado()
	{
		$response = $this->json('GET', '/relatorio/encarregado/busca', []);

		$response->assertStatus(200);

	}

	/**
	 * ResultEncarregado
	 *
	 * @return void
	 */
	public function testResultEncarregadoWithError()
	{
		$response = $this->json('POST', '/relatorio/encarregado/resultado', []);

		$response->assertStatus(400);

	}

	/**
	 * ResultEncarregado
	 *
	 * @return void
	 */
	public function testResultEncarregado()
	{
		$response = $this->json('POST', '/relatorio/encarregado/resultado', []);

		$response->assertStatus(200);

	}

	/**
	 * SearchOfendido
	 *
	 * @return void
	 */
	public function testSearchOfendidoWithError()
	{
		$response = $this->json('GET', '/relatorio/ofendido/busca', []);

		$response->assertStatus(400);

	}

	/**
	 * SearchOfendido
	 *
	 * @return void
	 */
	public function testSearchOfendido()
	{
		$response = $this->json('GET', '/relatorio/ofendido/busca', []);

		$response->assertStatus(200);

	}

	/**
	 * ResultOfendido
	 *
	 * @return void
	 */
	public function testResultOfendidoWithError()
	{
		$response = $this->json('POST', '/relatorio/ofendido/resultado', []);

		$response->assertStatus(400);

	}

	/**
	 * ResultOfendido
	 *
	 * @return void
	 */
	public function testResultOfendido()
	{
		$response = $this->json('POST', '/relatorio/ofendido/resultado', []);

		$response->assertStatus(200);

	}

	/**
	 * Defensor
	 *
	 * @return void
	 */
	public function testDefensorWithError()
	{
		$response = $this->json('GET', '/relatorio/defensor', []);

		$response->assertStatus(400);

	}

	/**
	 * Defensor
	 *
	 * @return void
	 */
	public function testDefensor()
	{
		$response = $this->json('GET', '/relatorio/defensor', []);

		$response->assertStatus(200);

	}

	/**
	 * Abuso
	 *
	 * @return void
	 */
	public function testAbusoWithError()
	{
		$response = $this->json('GET', '/relatorio/abuso', []);

		$response->assertStatus(400);

	}

	/**
	 * Abuso
	 *
	 * @return void
	 */
	public function testAbuso()
	{
		$response = $this->json('GET', '/relatorio/abuso', []);

		$response->assertStatus(200);

	}

	/**
	 * Violenciadomestica
	 *
	 * @return void
	 */
	public function testViolenciadomesticaWithError()
	{
		$response = $this->json('GET', '/relatorio/violenciadomestica', []);

		$response->assertStatus(400);

	}

	/**
	 * Violenciadomestica
	 *
	 * @return void
	 */
	public function testViolenciadomestica()
	{
		$response = $this->json('GET', '/relatorio/violenciadomestica', []);

		$response->assertStatus(200);

	}

}
