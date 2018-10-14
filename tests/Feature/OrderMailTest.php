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

    public function test_send_mail()
    {
        Mail::fake();
        $user1 = factory(User::class)->create();
        dd($user1);
        $response =  $this->actingAs($user1)->json('POST', '/api/v1/1');
        $response->assertStatus(200);

        Mail::assertSent(SendOrderMail::class, 1);
    }
}
