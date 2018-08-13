<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthorTest extends TestCase
{
	public function testAuthorsWithoutAuth()
	{
		$response = $this->get('/authors');
		$response->assertStatus(302);  // not logged in, should be redirected to login page
	}

	public function testAuthorsWithAuth()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->get('/authors');
		$response->assertStatus(200);
	}

	public function testAuthorCreateWithoutName()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/authors', ['birthday' => '1992-01-01']);
		$response->assertSee('The name field is required');
	}

	public function testAuthorCreateWithoutBirthdate()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/authors', ['name' => 'Jim Smith']);
		$response->assertSee('The birthday field is required');
	}

	public function testAuthorCreateWithBadBirthdate()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->json('POST', '/authors', ['name' => 'Jim Smith', 'birthday' => '1/1/1992']);
		$response->assertSee('The birthday does not match the format Y-m-d');
	}

}
