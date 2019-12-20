<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PendenciaTest extends TestCase
{
	/**
	 * Trocaropm
	 *
	 * @return void
	 */
	public function testTrocaropmWithError()
	{
		$response = $this->json('GET', '/pendencia/trocaropm', []);

		$response->assertStatus(400);

	}

	/**
	 * Trocaropm
	 *
	 * @return void
	 */
	public function testTrocaropm()
	{
		$response = $this->json('GET', '/pendencia/trocaropm', []);

		$response->assertStatus(200);

	}

	/**
	 * HomeOutraOM
	 *
	 * @return void
	 */
	public function testHomeOutraOMWithError()
	{
		$response = $this->json('POST', '/pendencia/homeoutraom', []);

		$response->assertStatus(400);

	}

	/**
	 * HomeOutraOM
	 *
	 * @return void
	 */
	public function testHomeOutraOM()
	{
		$response = $this->json('POST', '/pendencia/homeoutraom', []);

		$response->assertStatus(200);

	}

	/**
	 * Geral
	 *
	 * @return void
	 */
	public function testGeralWithError()
	{
		$response = $this->json('GET', '/pendencia/gerais', []);

		$response->assertStatus(400);

	}

	/**
	 * Geral
	 *
	 * @return void
	 */
	public function testGeral()
	{
		$response = $this->json('GET', '/pendencia/gerais', []);

		$response->assertStatus(200);

	}

	/**
	 * Graficos
	 *
	 * @return void
	 */
	public function testGraficosWithError()
	{
		$response = $this->json('GET', '/pendencia/graficos', []);

		$response->assertStatus(400);

	}

	/**
	 * Graficos
	 *
	 * @return void
	 */
	public function testGraficos()
	{
		$response = $this->json('GET', '/pendencia/graficos', []);

		$response->assertStatus(200);

	}

	/**
	 * Comportamento
	 *
	 * @return void
	 */
	public function testComportamentoWithError()
	{
		$response = $this->json('GET', '/pendencia/comportamento', []);

		$response->assertStatus(400);

	}

	/**
	 * Comportamento
	 *
	 * @return void
	 */
	public function testComportamento()
	{
		$response = $this->json('GET', '/pendencia/comportamento', []);

		$response->assertStatus(200);

	}

	/**
	 * Punicoes
	 *
	 * @return void
	 */
	public function testPunicoesWithError()
	{
		$response = $this->json('GET', '/pendencia/punicoes', []);

		$response->assertStatus(400);

	}

	/**
	 * Punicoes
	 *
	 * @return void
	 */
	public function testPunicoes()
	{
		$response = $this->json('GET', '/pendencia/punicoes', []);

		$response->assertStatus(200);

	}

	/**
	 * Quantidade
	 *
	 * @return void
	 */
	public function testQuantidadeWithError()
	{
		$response = $this->json('GET', '/pendencia/quantidade', []);

		$response->assertStatus(400);

	}

	/**
	 * Quantidade
	 *
	 * @return void
	 */
	public function testQuantidade()
	{
		$response = $this->json('GET', '/pendencia/quantidade', []);

		$response->assertStatus(200);

	}

	/**
	 * Sobrestamentos
	 *
	 * @return void
	 */
	public function testSobrestamentosWithError()
	{
		$response = $this->json('GET', '/pendencia/sobrestamentos', []);

		$response->assertStatus(400);

	}

	/**
	 * Sobrestamentos
	 *
	 * @return void
	 */
	public function testSobrestamentos()
	{
		$response = $this->json('GET', '/pendencia/sobrestamentos', []);

		$response->assertStatus(200);

	}

}
