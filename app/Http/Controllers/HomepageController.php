<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomepageController extends Controller
{
    public function homepage(): Response
    {
        return Inertia::render('Homepage');
    }
}
