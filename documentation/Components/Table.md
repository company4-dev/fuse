# Table
JellyBean extends FluxUI's [table component](https://fluxui.dev/components/table) standardising table layout across pages with ease.

Table classes can be made by following the *Make Table* prompts in the `php artisan jb` command menu.

## Class
The Table class defines how the table is structured as well as how the data is fetched.

It will always include the `BaseTable` trait to ensure compatibility.

The Table class supports the following methods:

### `actions(): array`
This required method allows you to set the actions performed on the rows.

### `columns(): array`
This required method allows you to define the table columns.

### `query($query, $id = null)`
This optional method allows you to adjust how the query is run. For example if you add an `id` attribute (as described below), you could filter the results based on that id.

## Component
To map up the Table class with the view, you can add the one of the following options.

Passing an ID allows you to perform a table query depending on what was passed.

> Note: The table component should never be the only html element in the Volt component.

```html
<!-- Default -->
// <livewire:table table="{platform}::{table}" />
<livewire:table table="platform::users" />

<!-- With an ID -->
// <livewire:table :id="{id}" table="{platform}::{table}" />
<livewire:table :id="1" table="platform::holiday-buddies" />

<!-- With an ID and a feature -->
// <livewire:table :id="{id}" table="{platform}::{feature.table}" />
<livewire:table :id="1" table="platform::feature.address" />
```
