# Base Model Trait
All methods are required to use this trait and is enforced via testing.

## Methods
[Find or Redirect](#findorredirect)

### FindOrRedirect
This method is an extension of the [Find Or](https://api.laravel.com/docs/12.x/Illuminate/Database/Eloquent/Builder.html#method_findOr) Laravel method, that will redirect you to the specified path if the model can't be found.

### Usage
```php
use App\Models\User;

User::findOrRedirect(1, route('users.list'));
```

#### Properties
1. `$id`<br>The Model ID to find.
2. `string $redirect`<br>The path to redirect to if the model can't be found.
3. `$columns`<br>The columns to fetch.
