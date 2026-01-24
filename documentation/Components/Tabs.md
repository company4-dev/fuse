# Tabs
JellyBean extends FluxUI's [tabs components](https://fluxui.dev/components/tabs) standardising tabs across pages with ease.

This page covers documentation for both the [Tabs](#tabs-component) and [Tab](#tab-component) components.

## Tabs Component
The tabs component accepts a `:tabs` attribute which defines the tab list.

In our Volt component our tabs state is `'tabs'` so we can just pass `:$tabs` to the component (which is the same as `:tabs="$tabs"`).

The tabs state accepts an array of tab definitions, within each we set the `icon` and the raw translation string as the `label`, this will be used to match up to the individual tab components.

```php
// The Livewire functions we need
use function Livewire\Volt\mount;
use function Livewire\Volt\state;

mount(function () {
    $this->tabs = [
        [
            'icon'  => 'icons',
            'label' => 'dictionary.icons'
        ],
        [
            'icon'  => 'pizza-slice',
            'label' => 'dictionary.pizza'
        ]
    ];
});

// Pass the form to Livewire
state([
    'tabs' => null,
]);
```

```html
<x-tabs :$tabs />
```

## Tab Component
The tab components site within the tabs component and accepts a `target` attribute which is the same raw translation string as passed in the label of the tab definition in the `'tabs'` state in our page PHP.

Within the tab is the content for the tab.

```html
<x-tab target="dictionary.icons">
    // Content for icons tab
</x-tab>
```

## Full HTML
```html
<x-tabs :$tabs>
    <x-tab target="dictionary.icons">
        // Content for icons tab
    </x-tab>

    <x-tab target="dictionary.pizza">
        // Content for pizza tab
    </x-tab>
</x-tabs>
```
