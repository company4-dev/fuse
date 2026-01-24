# Mount
The mount method is called when the component is initially rendered and will set-up the layout for the page as well as initialise default data, such as models for an edit page.

## The `Livewire::layout()` Helper
This helper is required to populate the base layout.

### Properties

1. `string $avatar`:<br>A `string` of either an icon name or a full URL to an image.
2. `array $breadcrumbs`:<br>A `key/value array` of links and titles, where the key is the route string and the value is the title for the route.<br><br>If no route is passed, then the breadcrumb won't be linked, useful for the trailing breadcrumb.<br><br>To pass additional variables to the route (such as the `id`), append `:` to the route string, followed by a CSV of values. E.g. `users.edit:1` or `users.edit:1,address,3`.
3. `array|null $menu`<br>A `2D array` of menu items with the following keys:
   1. `string icon`<br>The icon for the menu item
   2. `array|string label`<br>The translation string for the menu item. This can be a string for a simple translation like `dictionary.user`.<br><br>For translations with parameters, pass an array with the translation key as the first value and an array of the translation placeholders to translate and populate. E.g.: `[phrases.add, ['dictionary.user']]`
   3. `array|string route`<br>The route for the menu item. This can be a string for a simple route like `users.list`.<br><br>For routes with parameters, if there is only one, this can be a passed as is (E.g. `[users.edit, $user->id]`), for anything else pass an array (E.g. `[users.edit-address, [$user->id, $user->address_id]]`)
