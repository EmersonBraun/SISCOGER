<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SobrestamentoTest extends TestCase
{
	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserirWithError()
	{
		$response = $this->json('POST', '/sobrestamento/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserir()
	{
		$response = $this->json('POST', '/sobrestamento/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/sobrestamento', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/sobrestamento', []);

		$response->assertStatus(200);

	}

	/**
	 * Adl
	 *
	 * @return void
	 */
	public function testAdlWithError()
	{
		$response = $this->json('GET', '/sobrestamento/adl', []);

		$response->assertStatus(400);

	}

	/**
	 * Adl
	 *
	 * @return void
	 */
	public function testAdl()
	{
		$response = $this->json('GET', '/sobrestamento/adl', []);

		$response->assertStatus(200);

	}

	/**
	 * Cd
	 *
	 * @return void
	 */
	public function testCdWithError()
	{
		$response = $this->json('GET', '/sobrestamento/cd', []);

		$response->assertStatus(400);

	}

	/**
	 * Cd
	 *
	 * @return void
	 */
	public function testCd()
	{
		$response = $this->json('GET', '/sobrestamento/cd', []);

		$response->assertStatus(200);

	}

	/**
	 * Cj
	 *
	 * @return void
	 */
	public function testCjWithError()
	{
		$response = $this->json('GET', '/sobrestamento/cj', []);

		$response->assertStatus(400);

	}

	/**
	 * Cj
	 *
	 * @return void
	 */
	public function testCj()
	{
		$response = $this->json('GET', '/sobrestamento/cj', []);

		$response->assertStatus(200);

	}

	/**
	 * Fatd
	 *
	 * @return void
	 */
	public function testFatdWithError()
	{
		$response = $this->json('GET', '/sobrestamento/fatd', []);

		$response->assertStatus(400);

	}

	/**
	 * Fatd
	 *
	 * @return void
	 */
	public function testFatd()
	{
		$response = $this->json('GET', '/sobrestamento/fatd', []);

		$response->assertStatus(200);

	}

	/**
	 * It
	 *
	 * @return void
	 */
	public function testItWithError()
	{
		$response = $this->json('GET', '/sobrestamento/it', []);

		$response->assertStatus(400);

	}

	/**
	 * It
	 *
	 * @return void
	 */
	public function testIt()
	{
		$response = $this->json('GET', '/sobrestamento/it', []);

		$response->assertStatus(200);

	}

	/**
	 * Sindicancia
	 *
	 * @return void
	 */
	public function testSindicanciaWithError()
	{
		$response = $this->json('GET', '/sobrestamento/sindicancia', []);

		$response->assertStatus(400);

	}

	/**
	 * Sindicancia
	 *
	 * @return void
	 */
	public function testSindicancia()
	{
		$response = $this->json('GET', '/sobrestamento/sindicancia', []);

		$response->assertStatus(200);

	}

}
