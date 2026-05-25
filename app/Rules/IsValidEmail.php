<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\Extra\SpoofCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Concerns\FilterEmailValidation;
use Stringable;

class IsValidEmail implements ValidationRule
{
    protected array $parameters;

    public function __construct(...$parameters)
    {
        $this->parameters = $parameters;
    }

    public static function convert($value)
    {
        return str_contains($value, ',') ? explode(',', $value) : $value;
    }

    public static function is_valid(array|string $emails, array|string|null $validations = ['rfc', 'dns']): bool
    {
        if (is_string($emails) && str_contains($emails, ',')) {
            $emails = array_map(trim(...), explode(',', $emails));
        }

        if (!is_array($emails)) {
            $emails = [$emails];
        }

        if ($validations === null) {
            $validations = ['rfc', 'dns'];
        }

        $validations = collect($validations)
            ->unique()
            // phpcs:disable Generic.Files.LineLength.MaxExceeded
            ->map(static fn ($validation): RFCValidation|NoRFCWarningsValidation|DNSCheckValidation|SpoofCheckValidation|FilterEmailValidation|null => match ($validation) {
                'rfc'    => new RFCValidation,
                'strict' => new NoRFCWarningsValidation,
                'dns'    => new DNSCheckValidation,
                'spoof'  => new SpoofCheckValidation,
                'filter' => new FilterEmailValidation,
                default  => null,
            })
            // phpcs:enable Generic.Files.LineLength.MaxExceeded
            ->values()
            ->filter()
            ->all();

        // Always return true for this rule to be valid
        return array_all(
            $emails,
            static fn (string $email) => (new EmailValidator)
                ->isValid($email, new MultipleValidationWithAnd($validations))
        );
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) && (!$value instanceof Stringable)) {
            $fail('This field does not have a valid email');
        }

        if (!self::is_valid($value)) {
            $fail('This field does not have a valid email');
        }
    }
}
