<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class BookTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

	public function testBooksWithoutAuth()
	{
		$response = $this->get('/books');
		$response->assertStatus(302); // not logged in, should be redirected to login page
	}

	public function testBooksWithAuth()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->get('/books');
		$response->assertStatus(200);
	}

	public function testBookCreateWithoutTitle()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/books', ['author_id' => 2, 'publication_date' => '1992-01-01', 'pages' => 4]);
		$response->assertSee('The title field is required');
	}

	public function testBookCreateWithoutAuthor()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/books', ['title' => 'Great Title', 'publication_date' => '1992-01-01', 'pages' => 4]);
		$response->assertSee('The author id field is required');
	}

	public function testBookCreateWithoutPublicationDate()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/books', ['title' => 'Great Title', 'author_id' => 2, 'pages' => 4]);
		$response->assertSee('The publication date field is required');
	}

	public function testBookCreateWithBadPublicationDate()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/books', ['title' => 'Great Title', 'author_id' => 2, 'pages' => 4, 'publication_date' => '1/1/1992']);
		$response->assertSee('The publication date does not match the format Y-m-d');
	}

	public function testBookCreateWithoutPages()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/books', ['title' => 'Great Title', 'author_id' => 2, 'publication_date' => '1992-01-01']);
		$response->assertSee('The pages field is required');
	}
}
