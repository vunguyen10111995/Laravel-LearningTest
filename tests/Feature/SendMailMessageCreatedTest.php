<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Jobs\SendMailMessageCreated;
use App\Mail\MailCreateAccount;
use Illuminate\Support\Facades\Mail;

class SendMailMessageCreatedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_send_mail()
    {
        $user = factory(User::class)->create();

        Mail::fake();


        $job = new SendMailMessageCreated($user);

        $job->handle();

        return Mail::assertSent(MailCreateAccount::class, 1);
    }
}
