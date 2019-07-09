<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PendenciasTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/home/{opm}', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/home/{opm}', []);

		$response->assertStatus(200);

	}

	/**
	 * Trocaropm
	 *
	 * @return void
	 */
	public function testTrocaropmWithError()
	{
		$response = $this->json('GET', '/trocaropm', []);

		$response->assertStatus(400);

	}

	/**
	 * Trocaropm
	 *
	 * @return void
	 */
	public function testTrocaropm()
	{
		$response = $this->json('GET', '/trocaropm', []);

		$response->assertStatus(200);

	}

	/**
	 * Geral
	 *
	 * @return void
	 */
	public function testGeralWithError()
	{
		$response = $this->json('GET', '/pendencias/gerais', []);

		$response->assertStatus(400);

	}

	/**
	 * Geral
	 *
	 * @return void
	 */
	public function testGeral()
	{
		$response = $this->json('GET', '/pendencias/gerais', []);

		$response->assertStatus(200);

	}

	/**
	 * Comportamento
	 *
	 * @return void
	 */
	public function testComportamentoWithError()
	{
		$response = $this->json('GET', '/pendencias/comportamento', []);

		$response->assertStatus(400);

	}

	/**
	 * Comportamento
	 *
	 * @return void
	 */
	public function testComportamento()
	{
		$response = $this->json('GET', '/pendencias/comportamento', []);

		$response->assertStatus(200);

	}

	/**
	 * Punicoes
	 *
	 * @return void
	 */
	public function testPunicoesWithError()
	{
		$response = $this->json('GET', '/pendencias/punicoes', []);

		$response->assertStatus(400);

	}

	/**
	 * Punicoes
	 *
	 * @return void
	 */
	public function testPunicoes()
	{
		$response = $this->json('GET', '/pendencias/punicoes', []);

		$response->assertStatus(200);

	}

	/**
	 * Quantidade
	 *
	 * @return void
	 */
	public function testQuantidadeWithError()
	{
		$response = $this->json('GET', '/pendencias/quantidade', []);

		$response->assertStatus(400);

	}

	/**
	 * Quantidade
	 *
	 * @return void
	 */
	public function testQuantidade()
	{
		$response = $this->json('GET', '/pendencias/quantidade', []);

		$response->assertStatus(200);

	}

	/**
	 * Prioritarios
	 *
	 * @return void
	 */
	public function testPrioritariosWithError()
	{
		$response = $this->json('GET', '/pendencias/prioritarios', []);

		$response->assertStatus(400);

	}

	/**
	 * Prioritarios
	 *
	 * @return void
	 */
	public function testPrioritarios()
	{
		$response = $this->json('GET', '/pendencias/prioritarios', []);

		$response->assertStatus(200);

	}

	/**
	 * Sobrestamentos
	 *
	 * @return void
	 */
	public function testSobrestamentosWithError()
	{
		$response = $this->json('GET', '/pendencias/sobrestamentos', []);

		$response->assertStatus(400);

	}

	/**
	 * Sobrestamentos
	 *
	 * @return void
	 */
	public function testSobrestamentos()
	{
		$response = $this->json('GET', '/pendencias/sobrestamentos', []);

		$response->assertStatus(200);

	}

	/**
	 * Processos
	 *
	 * @return void
	 */
	public function testProcessosWithError()
	{
		$response = $this->json('GET', '/pendencias/processos', []);

		$response->assertStatus(400);

	}

	/**
	 * Processos
	 *
	 * @return void
	 */
	public function testProcessos()
	{
		$response = $this->json('GET', '/pendencias/processos', []);

		$response->assertStatus(200);

	}

	/**
	 * Postograd
	 *
	 * @return void
	 */
	public function testPostogradWithError()
	{
		$response = $this->json('GET', '/pendencias/postograd', []);

		$response->assertStatus(400);

	}

	/**
	 * Postograd
	 *
	 * @return void
	 */
	public function testPostograd()
	{
		$response = $this->json('GET', '/pendencias/postograd', []);

		$response->assertStatus(200);

	}

	/**
	 * Encarregados
	 *
	 * @return void
	 */
	public function testEncarregadosWithError()
	{
		$response = $this->json('GET', '/pendencias/encarregados', []);

		$response->assertStatus(400);

	}

	/**
	 * Encarregados
	 *
	 * @return void
	 */
	public function testEncarregados()
	{
		$response = $this->json('GET', '/pendencias/encarregados', []);

		$response->assertStatus(200);

	}

	/**
	 * Defensores
	 *
	 * @return void
	 */
	public function testDefensoresWithError()
	{
		$response = $this->json('GET', '/pendencias/defensores', []);

		$response->assertStatus(400);

	}

	/**
	 * Defensores
	 *
	 * @return void
	 */
	public function testDefensores()
	{
		$response = $this->json('GET', '/pendencias/defensores', []);

		$response->assertStatus(200);

	}

	/**
	 * Ofendidos
	 *
	 * @return void
	 */
	public function testOfendidosWithError()
	{
		$response = $this->json('GET', '/pendencias/ofendidos', []);

		$response->assertStatus(400);

	}

	/**
	 * Ofendidos
	 *
	 * @return void
	 */
	public function testOfendidos()
	{
		$response = $this->json('GET', '/pendencias/ofendidos', []);

		$response->assertStatus(200);

	}

}
