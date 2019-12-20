<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstatusTest extends TestCase
{
	/**
	 * OperacaoVerao
	 *
	 * @return void
	 */
	public function testOperacaoVeraoWithError()
	{
		$response = $this->json('GET', '/api/estatuspm/operacaoverao', []);

		$response->assertStatus(400);

	}

	/**
	 * OperacaoVerao
	 *
	 * @return void
	 */
	public function testOperacaoVerao()
	{
		$response = $this->json('GET', '/api/estatuspm/operacaoverao', []);

		$response->assertStatus(200);

	}

	/**
	 * Total
	 *
	 * @return void
	 */
	public function testTotalWithError()
	{
		$response = $this->json('GET', '/api/estatuspm/{rg}', []);

		$response->assertStatus(400);

	}

	/**
	 * Total
	 *
	 * @return void
	 */
	public function testTotal()
	{
		$response = $this->json('GET', '/api/estatuspm/{rg}', []);

		$response->assertStatus(200);

	}

}
