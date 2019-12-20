<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FDIListTest extends TestCase
{
	/**
	 * Tramitacao
	 *
	 * @return void
	 */
	public function testTramitacaoWithError()
	{
		$response = $this->json('GET', '/api/tramitacao/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Tramitacao
	 *
	 * @return void
	 */
	public function testTramitacao()
	{
		$response = $this->json('GET', '/api/tramitacao/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * DadosGerais
	 *
	 * @return void
	 */
	public function testDadosGeraisWithError()
	{
		$response = $this->json('GET', '/api/fdi/dadosGerais/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * DadosGerais
	 *
	 * @return void
	 */
	public function testDadosGerais()
	{
		$response = $this->json('GET', '/api/fdi/dadosGerais/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * DadosAdicionais
	 *
	 * @return void
	 */
	public function testDadosAdicionaisWithError()
	{
		$response = $this->json('GET', '/api/fdi/dadosAdicionais/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * DadosAdicionais
	 *
	 * @return void
	 */
	public function testDadosAdicionais()
	{
		$response = $this->json('GET', '/api/fdi/dadosAdicionais/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Suspenso
	 *
	 * @return void
	 */
	public function testSuspensoWithError()
	{
		$response = $this->json('GET', '/api/fdi/suspenso/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Suspenso
	 *
	 * @return void
	 */
	public function testSuspenso()
	{
		$response = $this->json('GET', '/api/fdi/suspenso/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Excluido
	 *
	 * @return void
	 */
	public function testExcluidoWithError()
	{
		$response = $this->json('GET', '/api/fdi/excluido/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Excluido
	 *
	 * @return void
	 */
	public function testExcluido()
	{
		$response = $this->json('GET', '/api/fdi/excluido/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * SubJudice
	 *
	 * @return void
	 */
	public function testSubJudiceWithError()
	{
		$response = $this->json('GET', '/api/fdi/subJudice/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * SubJudice
	 *
	 * @return void
	 */
	public function testSubJudice()
	{
		$response = $this->json('GET', '/api/fdi/subJudice/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Afastamentos
	 *
	 * @return void
	 */
	public function testAfastamentosWithError()
	{
		$response = $this->json('GET', '/api/fdi/afastamentos/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Afastamentos
	 *
	 * @return void
	 */
	public function testAfastamentos()
	{
		$response = $this->json('GET', '/api/fdi/afastamentos/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Dependentes
	 *
	 * @return void
	 */
	public function testDependentesWithError()
	{
		$response = $this->json('GET', '/api/fdi/dependentes/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Dependentes
	 *
	 * @return void
	 */
	public function testDependentes()
	{
		$response = $this->json('GET', '/api/fdi/dependentes/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Sai
	 *
	 * @return void
	 */
	public function testSaiWithError()
	{
		$response = $this->json('GET', '/api/fdi/sai/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Sai
	 *
	 * @return void
	 */
	public function testSai()
	{
		$response = $this->json('GET', '/api/fdi/sai/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Objetos
	 *
	 * @return void
	 */
	public function testObjetosWithError()
	{
		$response = $this->json('GET', '/api/fdi/objetos/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Objetos
	 *
	 * @return void
	 */
	public function testObjetos()
	{
		$response = $this->json('GET', '/api/fdi/objetos/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Membros
	 *
	 * @return void
	 */
	public function testMembrosWithError()
	{
		$response = $this->json('GET', '/api/fdi/membros/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Membros
	 *
	 * @return void
	 */
	public function testMembros()
	{
		$response = $this->json('GET', '/api/fdi/membros/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Punicoes
	 *
	 * @return void
	 */
	public function testPunicoesWithError()
	{
		$response = $this->json('GET', '/api/fdi/punicoes/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Punicoes
	 *
	 * @return void
	 */
	public function testPunicoes()
	{
		$response = $this->json('GET', '/api/fdi/punicoes/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Apresentacoes
	 *
	 * @return void
	 */
	public function testApresentacoesWithError()
	{
		$response = $this->json('GET', '/api/fdi/apresentacoes/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Apresentacoes
	 *
	 * @return void
	 */
	public function testApresentacoes()
	{
		$response = $this->json('GET', '/api/fdi/apresentacoes/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * ProcOutros
	 *
	 * @return void
	 */
	public function testProcOutrosWithError()
	{
		$response = $this->json('GET', '/api/fdi/procOutros/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * ProcOutros
	 *
	 * @return void
	 */
	public function testProcOutros()
	{
		$response = $this->json('GET', '/api/fdi/procOutros/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Log
	 *
	 * @return void
	 */
	public function testLogWithError()
	{
		$response = $this->json('GET', '/api/fdi/log/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Log
	 *
	 * @return void
	 */
	public function testLog()
	{
		$response = $this->json('GET', '/api/fdi/log/{rg}', []);

		$response->assertStatus(200);

	}

	/**
	 * Cautelas
	 *
	 * @return void
	 */
	public function testCautelasWithError()
	{
		$response = $this->json('GET', '/api/fdi/cautelas/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Cautelas
	 *
	 * @return void
	 */
	public function testCautelas()
	{
		$response = $this->json('GET', '/api/fdi/cautelas/{rg}', []);

		$response->assertStatus(200);

	}

}
