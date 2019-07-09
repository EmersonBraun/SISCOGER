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
	 * Getpmrg
	 *
	 * @return void
	 */
	public function testGetpmrgWithError()
	{
		$response = $this->json('POST', '/busca/getpmrg/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Getpmrg
	 *
	 * @return void
	 */
	public function testGetpmrg()
	{
		$response = $this->json('POST', '/busca/getpmrg/{rg}', []);

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
	 * Ofendido
	 *
	 * @return void
	 */
	public function testOfendidoWithError()
	{
		$response = $this->json('GET', '/busca/ofendido', []);

		$response->assertStatus(400);

	}

	/**
	 * Ofendido
	 *
	 * @return void
	 */
	public function testOfendido()
	{
		$response = $this->json('GET', '/busca/ofendido', []);

		$response->assertStatus(200);

	}

	/**
	 * Envolvido
	 *
	 * @return void
	 */
	public function testEnvolvidoWithError()
	{
		$response = $this->json('GET', '/busca/envolvido', []);

		$response->assertStatus(400);

	}

	/**
	 * Envolvido
	 *
	 * @return void
	 */
	public function testEnvolvido()
	{
		$response = $this->json('GET', '/busca/envolvido', []);

		$response->assertStatus(200);

	}

	/**
	 * Documentacao
	 *
	 * @return void
	 */
	public function testDocumentacaoWithError()
	{
		$response = $this->json('GET', '/busca/documentacao', []);

		$response->assertStatus(400);

	}

	/**
	 * Documentacao
	 *
	 * @return void
	 */
	public function testDocumentacao()
	{
		$response = $this->json('GET', '/busca/documentacao', []);

		$response->assertStatus(200);

	}

	/**
	 * Pdf
	 *
	 * @return void
	 */
	public function testPdfWithError()
	{
		$response = $this->json('GET', '/busca/pdf', []);

		$response->assertStatus(400);

	}

	/**
	 * Pdf
	 *
	 * @return void
	 */
	public function testPdf()
	{
		$response = $this->json('GET', '/busca/pdf', []);

		$response->assertStatus(200);

	}

	/**
	 * Tramitacao
	 *
	 * @return void
	 */
	public function testTramitacaoWithError()
	{
		$response = $this->json('GET', '/busca/tramitacao', []);

		$response->assertStatus(400);

	}

	/**
	 * Tramitacao
	 *
	 * @return void
	 */
	public function testTramitacao()
	{
		$response = $this->json('GET', '/busca/tramitacao', []);

		$response->assertStatus(200);

	}

}
