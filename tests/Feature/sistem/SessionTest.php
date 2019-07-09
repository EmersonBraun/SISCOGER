<?php

namespace Tests\Feature\sistem;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionTest extends TestCase
{
	/**
	 * Dados
	 *
	 * @return void
	 */
	public function testDadosWithError()
	{
		$response = $this->json('GET', '/session/dados', []);

		$response->assertStatus(400);

	}

	/**
	 * Dados
	 *
	 * @return void
	 */
	public function testDados()
	{
		$response = $this->json('GET', '/session/dados', []);

		$response->assertStatus(200);

	}

}
