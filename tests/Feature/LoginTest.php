<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
	public function testAuth()
	{
		$user = factory(User::class)->create();
		$response = $this->actingAs($user)->get('/home');
		$response->assertSee('You are logged in');
	}

}
