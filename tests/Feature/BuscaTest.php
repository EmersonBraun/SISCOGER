<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuscaTest extends TestCase
{
	/**
	 * Pm
	 *
	 * @return void
	 */
	public function testPmWithError()
	{
		$response = $this->json('GET', '/busca/pm', []);

		$response->assertStatus(400);

	}

	/**
	 * Pm
	 *
	 * @return void
	 */
	public function testPm()
	{
		$response = $this->json('GET', '/busca/pm', []);

		$response->assertStatus(200);

	}

	/**
	 * Fdi
	 *
	 * @return void
	 */
	public function testFdiWithError()
	{
		$response = $this->json('POST', '/busca/fdi', []);

		$response->assertStatus(400);

	}

	/**
	 * Fdi
	 *
	 * @return void
	 */
	public function testFdi()
	{
		$response = $this->json('POST', '/busca/fdi', []);

		$response->assertStatus(200);

	}

	/**
	 * Completadados
	 *
	 * @return void
	 */
	public function testCompletadadosWithError()
	{
		$response = $this->json('POST', '/busca/completadados', []);

		$response->assertStatus(400);

	}

	/**
	 * Completadados
	 *
	 * @return void
	 */
	public function testCompletadados()
	{
		$response = $this->json('POST', '/busca/completadados', []);

		$response->assertStatus(200);

	}

	/**
	 * Opcoesnome
	 *
	 * @return void
	 */
	public function testOpcoesnomeWithError()
	{
		$response = $this->json('POST', '/busca/opcoes/nome', []);

		$response->assertStatus(400);

	}

	/**
	 * Opcoesnome
	 *
	 * @return void
	 */
	public function testOpcoesnome()
	{
		$response = $this->json('POST', '/busca/opcoes/nome', []);

		$response->assertStatus(200);

	}

	/**
	 * Opcoesrg
	 *
	 * @return void
	 */
	public function testOpcoesrgWithError()
	{
		$response = $this->json('POST', '/busca/opcoes/rg', []);

		$response->assertStatus(400);

	}

	/**
	 * Opcoesrg
	 *
	 * @return void
	 */
	public function testOpcoesrg()
	{
		$response = $this->json('POST', '/busca/opcoes/rg', []);

		$response->assertStatus(200);

	}

	/**
	 * SearchOfendido
	 *
	 * @return void
	 */
	public function testSearchOfendidoWithError()
	{
		$response = $this->json('GET', '/busca/ofendido', []);

		$response->assertStatus(400);

	}

	/**
	 * SearchOfendido
	 *
	 * @return void
	 */
	public function testSearchOfendido()
	{
		$response = $this->json('GET', '/busca/ofendido', []);

		$response->assertStatus(200);

	}

	/**
	 * ResultOfendido
	 *
	 * @return void
	 */
	public function testResultOfendidoWithError()
	{
		$response = $this->json('POST', '/busca/ofendido/resultado', []);

		$response->assertStatus(400);

	}

	/**
	 * ResultOfendido
	 *
	 * @return void
	 */
	public function testResultOfendido()
	{
		$response = $this->json('POST', '/busca/ofendido/resultado', []);

		$response->assertStatus(200);

	}

	/**
	 * SearchEnvolvido
	 *
	 * @return void
	 */
	public function testSearchEnvolvidoWithError()
	{
		$response = $this->json('GET', '/busca/envolvido', []);

		$response->assertStatus(400);

	}

	/**
	 * SearchEnvolvido
	 *
	 * @return void
	 */
	public function testSearchEnvolvido()
	{
		$response = $this->json('GET', '/busca/envolvido', []);

		$response->assertStatus(200);

	}

	/**
	 * ResultEnvolvido
	 *
	 * @return void
	 */
	public function testResultEnvolvidoWithError()
	{
		$response = $this->json('POST', '/busca/envolvido/resultado', []);

		$response->assertStatus(400);

	}

	/**
	 * ResultEnvolvido
	 *
	 * @return void
	 */
	public function testResultEnvolvido()
	{
		$response = $this->json('POST', '/busca/envolvido/resultado', []);

		$response->assertStatus(200);

	}

	/**
	 * SearchNominal
	 *
	 * @return void
	 */
	public function testSearchNominalWithError()
	{
		$response = $this->json('GET', '/busca/nominal', []);

		$response->assertStatus(400);

	}

	/**
	 * SearchNominal
	 *
	 * @return void
	 */
	public function testSearchNominal()
	{
		$response = $this->json('GET', '/busca/nominal', []);

		$response->assertStatus(200);

	}

	/**
	 * ResultNominal
	 *
	 * @return void
	 */
	public function testResultNominalWithError()
	{
		$response = $this->json('POST', '/busca/nominal/resultado', []);

		$response->assertStatus(400);

	}

	/**
	 * ResultNominal
	 *
	 * @return void
	 */
	public function testResultNominal()
	{
		$response = $this->json('POST', '/busca/nominal/resultado', []);

		$response->assertStatus(200);

	}

	/**
	 * Tramitacao
	 *
	 * @return void
	 */
	public function testTramitacaoWithError()
	{
		$response = $this->json('GET', '/busca/tramitacao/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Tramitacao
	 *
	 * @return void
	 */
	public function testTramitacao()
	{
		$response = $this->json('GET', '/busca/tramitacao/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * TramitacaoCoger
	 *
	 * @return void
	 */
	public function testTramitacaoCogerWithError()
	{
		$response = $this->json('GET', '/busca/tramitacaocoger/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * TramitacaoCoger
	 *
	 * @return void
	 */
	public function testTramitacaoCoger()
	{
		$response = $this->json('GET', '/busca/tramitacaocoger/{ano}', []);

		$response->assertStatus(200);

	}

}
