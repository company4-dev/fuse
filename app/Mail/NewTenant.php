<?php

declare(strict_types=1);

namespace App\Mail;

use App\Helpers\Collection;
use App\Helpers\Log;

class NewTenant extends BaseMail
{
    /**
     * Create a new message instance.
     */
    public function __construct($recipient, array|Collection|null $data = null)
    {
        Log::emergency('Move to Platform folder');
        parent::__construct(
            recipient: $recipient,
            data:      $data,
        );
    }
}
