<?php

namespace App\Http\Controllers\Api;

use App\Mail\SendOrderMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function event(int $event)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SendOrderMail($event));
    }
}
