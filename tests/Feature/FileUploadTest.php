<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileUploadTest extends TestCase
{
	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStoreWithError()
	{
		$response = $this->json('POST', '/api/fileupload/store', []);

		$response->assertStatus(400);

	}

	/**
	 * Store
	 *
	 * @return void
	 */
	public function testStore()
	{
		$response = $this->json('POST', '/api/fileupload/store', []);

		$response->assertStatus(200);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShowWithError()
	{
		$response = $this->json('GET', '/api/fileupload/show/{proc}/{procid}/{arquivo}/{hash}', []);

		$response->assertStatus(400);

	}

	/**
	 * Show
	 *
	 * @return void
	 */
	public function testShow()
	{
		$response = $this->json('GET', '/api/fileupload/show/{proc}/{procid}/{arquivo}/{hash}', []);

		$response->assertStatus(200);

	}

	/**
	 * Download
	 *
	 * @return void
	 */
	public function testDownloadWithError()
	{
		$response = $this->json('GET', '/api/fileupload/download/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Download
	 *
	 * @return void
	 */
	public function testDownload()
	{
		$response = $this->json('GET', '/api/fileupload/download/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Delete
	 *
	 * @return void
	 */
	public function testDeleteWithError()
	{
		$response = $this->json('DELETE', '/api/fileupload/delete/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Delete
	 *
	 * @return void
	 */
	public function testDelete()
	{
		$response = $this->json('DELETE', '/api/fileupload/delete/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroyWithError()
	{
		$response = $this->json('DELETE', '/api/fileupload/destroy/{id}', []);

		$response->assertStatus(400);

	}

	/**
	 * Destroy
	 *
	 * @return void
	 */
	public function testDestroy()
	{
		$response = $this->json('DELETE', '/api/fileupload/destroy/{id}', []);

		$response->assertStatus(200);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndexWithError()
	{
		$response = $this->json('GET', '/api/fileupload/list/{proc}/{id}/{arquivo}', []);

		$response->assertStatus(400);

	}

	/**
	 * Index
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$response = $this->json('GET', '/api/fileupload/list/{proc}/{id}/{arquivo}', []);

		$response->assertStatus(200);

	}

}
