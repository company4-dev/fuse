# Run FontAwesome Cache
JellyBean uses FontAwesome Pro 6 for its icons.

Do to licensing reasons these files aren't loaded via composer or NPM, but are processed through the `/resources/vendor/fontawesome`
directory.

## Updating Icons
1. Drop the `.svg` files from the desired style into the `/resources/vendor/fontawesome/` directory.

   The icons path should be `/resources/vendor/fontawesome/[icon].svg`.
2. Next we need to make them compatible with FluxUI.

   To do this run `php artisan jb:cache-font-awesome`.

   The icons should now have been moved to `/resources/views/flux/icon/[icon].blade.php` with some PHP above the SVG tag.
