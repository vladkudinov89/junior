<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function event(int $event) : void
    {
        Mail::to($this->user)->send(new RateChanged($this->user, $this->currency, $this->oldRate));
    }
}
