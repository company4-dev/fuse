# Commands
All JellyBean commands are accessible via `php artisan jb`.

## List
1. [Make Component](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Make-Component.md)
2. [Make Form](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Make-Form.md)
3. [Make Mail](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Make-Mail.md)
4. [Make Migration](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Make-Migration.md)
5. [Make Model](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Make-Model.md)
6. [Make Table](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Make-Table.md)
7. [Run FontAwesome Cache](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Run-FontAwesome-Cache.md)
8. [Run Tenant Migrations](https://bitbucket.org/jellyhaus/jellybean/src/main/documentation/Commands/Run-Tenant-Migrations.md)

## Writing a Command
When writing a command, use `$this->getPlatform()` to prompt for a platform.

If this method doesn't exist, you'll need to include the below:

```php
use App\Traits\BaseCommand;

class ClassName extends Command
{
    use BaseCommand;

    public function handle()
    {
        $platform = $this->getPlatform();
    }
}
```
