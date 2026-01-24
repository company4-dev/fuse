# Form
JellyBean extends Livewire's form functionality to improve consistency and simplify form creation.

Form classes can be made by following the *Make Form* prompts in the `php artisan jb` command menu.

## Class
// Awaiting documentation

## Component
Within the component we need to add a few key pieces of functionality, this is already included within the default *Make Page* prompts in the `php artisan jb` command menu to make life easier.

Within the PHP section of the Volt component, you'll need to set-up the form with the following:

```php
// The Form class
use Platforms\OpsFM\View\Forms\Locations\Add;

// The Livewire functions we need
use function Livewire\Volt\form;
use function Livewire\Volt\state;

// Pass the form to Livewire
form(Add::class);
state([
    'location' => null,
]);
```

When your form is editing a model, you'll need to populate the form with data. This is done via the mount method:

```php
mount(function ($id) {
    // Allocate the state to the model (we'll need this when saving)
    $this->location = Location::findOrRedirect($id, route('opsfm::locations.list', $id));

    // Pass the model to the form
    $this->form->model($this->location);

    // Other Mount functionality
});
```

Finally, within the html section, we should have the below, which helps prevent the page from becoming too wide.

```html
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
```
