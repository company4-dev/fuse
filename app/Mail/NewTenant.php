<?php

declare(strict_types=1);

namespace App\Mail;

use App\Helpers\Log;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class NewTenant extends BaseMail
{
    /**
     * Create a new message instance.
     */
    public function __construct(User $recipient, array|Collection|null $data = null)
    {
        Log::emergency('Move to Platform folder');
        parent::__construct(
            recipient: $recipient,
            data: $data,
        );
    }
}
