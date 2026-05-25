<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Helpers\Icons;
use App\Helpers\Log;
use App\Helpers\Tenants;
use App\Models\Setting;
use App\View\Forms\Management\Settings;
use Livewire\Attributes\Locked;

new class extends Component
{
    #[Locked]
    public bool $is_tenant = false;

    #[Locked]
    public $settings = [];

    public Settings $form;

    public function mount(): void
    {
        $this->is_tenant = Tenants::is_tenant();
        $this->settings  = config('settings');

        if ($this->is_tenant) {
            Log::critical('To Do: Implement tenant settings management');
        }

        $this->form->mount($this->settings);

        $this->layout(
            [
                'management' => 'dictionary.management',
                'dictionary.settings',
            ],
            Icons::settings(),
        );
    }

    public function submit(): void
    {
        $this->form->process($this, function (array $validated) {
            $defaults = collect(config('settings'))->dot()->toArray();

            Setting::truncate();

            foreach (collect($validated['settings'])->dot() as $key => $value) {
                $default = is_bool($defaults[$key]) ? (string) (int) $defaults[$key] : $defaults[$key];
                $value   = is_bool($value) ? (string) (int) $value : $value;

                if ($default !== $value) {
                    Log::emergency('To Do: Log changes');

                    [$group, $name] = explode('.', $key, 2);

                    Setting::create([
                        'group' => $group,
                        'name'  => $name,
                        'value' => $value,
                    ]);
                }
            }

            return $this->redirect(route('management.settings'));
        });
    }
};
?>

<div class="container">
    <flux:card>
        @if ($is_tenant)
            <x-callout variant="warning">You can't update any settings <em>yet</em></x-callout>
        @else
            <x-form :$form />
        @endif
    </flux:card>
</div>
