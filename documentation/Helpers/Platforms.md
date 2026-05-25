# Platforms
This helper provides simpler interaction with the [Nwidart\Modules](https://laravelmodules.com/docs/12) package.

## Methods
Before making use of this helper, make sure to include use `App\Helpers\Platforms`; at the top of each file where it will be used.

### `Platforms::find()`
Return a Platform by passing it's name or slug.

#### Arguments

1. ```php
    string $name
    ```
    The name of the platform to find.

#### Example Use
```php
use App\Helpers\Platforms;

echo Bootstrap::find('users');
```
