<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OPMApiTest extends TestCase
{
	/**
	 * Omsjd
	 *
	 * @return void
	 */
	public function testOmsjdWithError()
	{
		$response = $this->json('GET', '/api/acess/rhpr/{name}', []);

		$response->assertStatus(400);

	}

	/**
	 * Omsjd
	 *
	 * @return void
	 */
	public function testOmsjd()
	{
		$response = $this->json('GET', '/api/acess/rhpr/{name}', []);

		$response->assertStatus(200);

	}

}
