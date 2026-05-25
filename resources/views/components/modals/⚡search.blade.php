<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\View\Forms\Search;
use Livewire\Attributes\Defer;

new #[Defer()] class extends Component
{
    public Search $form;
}
?>

<flux:modal name="search" class="w-full max-w-[30rem] my-[12vh] max-h-screen min-w-[22rem] overflow-y-hidden">
    <x-form :$form type="inline" />
</flux:modal>
