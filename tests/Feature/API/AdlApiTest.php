<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdlApiTest extends TestCase
{
	/**
	 * Find
	 *
	 * @return void
	 */
	public function testFindWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/search/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Find
	 *
	 * @return void
	 */
	public function testFind()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/search/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * RefAno
	 *
	 * @return void
	 */
	public function testRefAnoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/refano/{ref}/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * RefAno
	 *
	 * @return void
	 */
	public function testRefAno()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/refano/{ref}/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * All
	 *
	 * @return void
	 */
	public function testAllWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/all', []);

		$response->assertStatus(400);

	}

	/**
	 * All
	 *
	 * @return void
	 */
	public function testAll()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/all', []);

		$response->assertStatus(200);

	}

	/**
	 * Ano
	 *
	 * @return void
	 */
	public function testAnoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/ano/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * Ano
	 *
	 * @return void
	 */
	public function testAno()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/ano/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Andamento
	 *
	 * @return void
	 */
	public function testAndamentoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/andamento', []);

		$response->assertStatus(400);

	}

	/**
	 * Andamento
	 *
	 * @return void
	 */
	public function testAndamento()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/andamento', []);

		$response->assertStatus(200);

	}

	/**
	 * AndamentoAno
	 *
	 * @return void
	 */
	public function testAndamentoAnoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/andamentoano/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * AndamentoAno
	 *
	 * @return void
	 */
	public function testAndamentoAno()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/andamentoano/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Prazos
	 *
	 * @return void
	 */
	public function testPrazosWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/prazos', []);

		$response->assertStatus(400);

	}

	/**
	 * Prazos
	 *
	 * @return void
	 */
	public function testPrazos()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/prazos', []);

		$response->assertStatus(200);

	}

	/**
	 * PrazosAno
	 *
	 * @return void
	 */
	public function testPrazosAnoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/prazosano/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * PrazosAno
	 *
	 * @return void
	 */
	public function testPrazosAno()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/prazosano/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * RelSituacao
	 *
	 * @return void
	 */
	public function testRelSituacaoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/relsituacao', []);

		$response->assertStatus(400);

	}

	/**
	 * RelSituacao
	 *
	 * @return void
	 */
	public function testRelSituacao()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/relsituacao', []);

		$response->assertStatus(200);

	}

	/**
	 * RelSituacaoAno
	 *
	 * @return void
	 */
	public function testRelSituacaoAnoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/relsituacaoano/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * RelSituacaoAno
	 *
	 * @return void
	 */
	public function testRelSituacaoAno()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/relsituacaoano/{ano}', []);

		$response->assertStatus(200);

	}

	/**
	 * Julgamento
	 *
	 * @return void
	 */
	public function testJulgamentoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/julgamento', []);

		$response->assertStatus(400);

	}

	/**
	 * Julgamento
	 *
	 * @return void
	 */
	public function testJulgamento()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/julgamento', []);

		$response->assertStatus(200);

	}

	/**
	 * JulgamentoAno
	 *
	 * @return void
	 */
	public function testJulgamentoAnoWithError()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/julgamentoano/{ano}', []);

		$response->assertStatus(400);

	}

	/**
	 * JulgamentoAno
	 *
	 * @return void
	 */
	public function testJulgamentoAno()
	{
		$response = $this->json('GET', '/api/sjd/proc/adl/julgamentoano/{ano}', []);

		$response->assertStatus(200);

	}

}
