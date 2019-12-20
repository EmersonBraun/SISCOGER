<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ICOTest extends TestCase
{
	/**
	 * Formatacao
	 *
	 * @return void
	 */
	public function testFormatacaoWithError()
	{
		$response = $this->json('GET', '/api/ico/{funcao}/{dado}', []);

		$response->assertStatus(400);

	}

	/**
	 * Formatacao
	 *
	 * @return void
	 */
	public function testFormatacao()
	{
		$response = $this->json('GET', '/api/ico/{funcao}/{dado}', []);

		$response->assertStatus(200);

	}

}
