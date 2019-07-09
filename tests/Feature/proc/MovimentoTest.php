<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovimentoTest extends TestCase
{
	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserirWithError()
	{
		$response = $this->json('POST', '/movimento/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Inserir
	 *
	 * @return void
	 */
	public function testInserir()
	{
		$response = $this->json('POST', '/movimento/{id}', []);

		$response->assertStatus(200);

	}

}
