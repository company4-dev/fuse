<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Stancl\Tenancy\Features\UserImpersonation;

class UserImpersonationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($token): RedirectResponse
    {
        return UserImpersonation::makeResponse($token);
    }
}
