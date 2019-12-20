<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DadosOmTest extends TestCase
{
	/**
	 * Comando
	 *
	 * @return void
	 */
	public function testComandoWithError()
	{
		$response = $this->json('GET', '/autoridadeom/comando', []);

		$response->assertStatus(400);

	}

	/**
	 * Comando
	 *
	 * @return void
	 */
	public function testComando()
	{
		$response = $this->json('GET', '/autoridadeom/comando', []);

		$response->assertStatus(200);

	}

	/**
	 * Outras
	 *
	 * @return void
	 */
	public function testOutrasWithError()
	{
		$response = $this->json('GET', '/autoridadeom/outras', []);

		$response->assertStatus(400);

	}

	/**
	 * Outras
	 *
	 * @return void
	 */
	public function testOutras()
	{
		$response = $this->json('GET', '/autoridadeom/outras', []);

		$response->assertStatus(200);

	}

	/**
	 * Form
	 *
	 * @return void
	 */
	public function testFormWithError()
	{
		$response = $this->json('GET', '/autoridadeom/formulario', []);

		$response->assertStatus(400);

	}

	/**
	 * Form
	 *
	 * @return void
	 */
	public function testForm()
	{
		$response = $this->json('GET', '/autoridadeom/formulario', []);

		$response->assertStatus(200);

	}

}
