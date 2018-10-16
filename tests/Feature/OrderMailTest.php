<?php

namespace Tests\Feature;

use App\Mail\SendOrderMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderMailTest extends TestCase
{
    use RefreshDatabase;

    const ENDPOINT = '/api/v1/new_order';

    public function test_endpoint_not_auth()
    {
        $response =  $this->json('POST', self::ENDPOINT);
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(401);
    }

    public function test_bad_request()
    {
        $user = factory(User::class)->create();
        $response =  $this->actingAs($user , 'api')->json('POST', self::ENDPOINT , [
            'order' => 15
        ]);

        $response->assertStatus(422);
    }

    public function test_send_mail_auth_api()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $api_token = str_random(60);

        $response =  $this->actingAs($user , 'api')->json('POST', self::ENDPOINT , [
            'order' => 15,
            'api_token' => $api_token
        ]);

        $response->assertStatus(200);

        Mail::assertSent(SendOrderMail::class, 1);
    }
}
