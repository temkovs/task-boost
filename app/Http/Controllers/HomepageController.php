<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomepageController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $showAuthModal = [
            'showLogin' => $request->routeIs('login'),
            'showRegister' => $request->routeIs('register'),
        ];

        return Inertia::render('Homepage', compact('showAuthModal'));
    }

    public function login(Request $request): Response
    {
        return $this->__invoke($request);
    }

    public function register(Request $request): Response
    {
        return $this->__invoke($request);
    }
}
