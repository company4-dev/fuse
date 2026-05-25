# Make Migration
Simplifies the database migration creation for Modules via `php artisan jb`.

This will create a base migration within `Platforms/{Platform}/database/migrations/{migration}.php` where `{Platform}` is your selected Platform and `{migration}` is the name of your migration prefixed with the migration creation date.

If you specified that this is a tenant migration, the migration will be created within the tenancy compatible directory `Platforms/{Platform}/database/migrations/tenant/{migration}.php`.

## Example
| Platform | Migration | For Tenant | Migration
| - | - | - | -
| OpsFM | create_locations_table | No | `Platforms/OpsFM/database/migrations/2025_09_23_155135_create_locations_table.php`
| OpsFM | create_locations_table | Yes | `Platforms/OpsFM/database/migrations/tenant/2025_09_23_155135_create_locations_table.php`
