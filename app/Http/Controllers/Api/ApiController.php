<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Mail\SendOrderMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function order(OrderRequest $request)
    {
        $order = $request->order;

        Mail::to(env('MAIL_FROM_ADDRESS', 'test.email@gmail.com'))->send(new SendOrderMail($order));
    }
}
