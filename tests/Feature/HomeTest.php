<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/home', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/home', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithErrorOpm()
	{
		$response = $this->json('GET', '/home/{opm}', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexOpm()
	{
		$response = $this->json('GET', '/home/{opm}', []);

		$response->assertStatus(200);

	}

	/**
	 * Logout
	 *
	 * @return void
	 */
	public function testLogoutWithError()
	{
		$response = $this->json('GET', '/logout', []);

		$response->assertStatus(400);

	}

	/**
	 * Logout
	 *
	 * @return void
	 */
	public function testLogout()
	{
		$response = $this->json('GET', '/logout', []);

		$response->assertStatus(200);

	}

}
