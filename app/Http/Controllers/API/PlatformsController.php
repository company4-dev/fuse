<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Helpers\GitHub;
use App\Helpers\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Nwidart\Modules\Facades\Module;

class PlatformsController extends Controller
{
    // phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClassBeforeLastUsed
    public function update(Request $request, string $platform): void
    {
        /**
         * The idea here is that on a git release, a webhook will target this endpoint* which will trigger a platform
         * update.
         *
         * This should then:
         *
         * 1. Create a new release directory (similar to deployer)
         * 2. Download the release files into a release directory
         * 3. Map the live platform to the latest release
         *
         * *[URL]/api/platforms/{platform}/update
         */
        Log::critical('Remove PHPCS comments when implemented');

        if (GitHub::is_push()) {
            $platform = Module::find($platform);

            if ($platform) {
                Log::debug(Process
                    // ::path('Platforms/'.$platform)
                    ::run('ls -lah'));
            }
        }
    }
    // phpcs:enable Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClassBeforeLastUsed
}
