<?php

namespace Fuse\Http\Controllers;

use Stancl\Tenancy\Features\UserImpersonation;

class UserImpersonationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($token)
    {
        return UserImpersonation::makeResponse($token);
    }
}
