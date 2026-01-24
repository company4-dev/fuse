# JellyBean Local Development Setup Guide

## Understanding the Architecture
- JellyBean is the underlying updatable platform for all Laravel development, this ensures consistent functionality throughout all projects and that any bugfixes apply to all installs. Platforms can be installed onto JellyBean in the same way that Apps can be installed onto Android.

### The Two Repositories

1. **JellyBean** (`git@bitbucket.org:jellyhaus/jellybean.git`)
   - Complete Laravel application (the "host")
   - Has `artisan`, `public/index.php`, all core Laravel files
   - Can run independently

2. **Platforms**
   - Laravel module (the "plugin")
   - Contains features that extend JellyBean
   - Cannot run without JellyBean

## Prerequisites
- **PHP** (via MAMP, see composer.json for version)
- **Node.js 18+** (24+ recommended)
- **MySQL** (via MAMP) (Whilst Laravel Supports the likes of SQLite, the Multi-tenancy app doesn't support it)
- **Composer**
- **Git** with SSH keys configured for Bitbucket

## Step 1: Clone Repositories
```bash
# Navigate to your Sites directory and clone JellyBean (the host Laravel app)
git clone git@bitbucket.org:jellyhaus/jellybean.git JellyBean

# Create OpsFM directory structure
cd JellyBean/Platforms

# Clone Platforms directly into this directory by following the Platform-specific installation instructions
```

Your directory structure should now be:

```bash
jellybean/              # Laravel host application
└── Platforms/
    └── [Platform]/     # The cloned Platform
```

### Set-up Git Modules
Git Modules allows you to manage multiple repositories in a single structure.

As developers may be working on different Platforms, this should not be committed to Git.

1. Create a new file in the JellyBean root `.gitmodules`
2. Use the following template to add in the platform:
   ```bash
   [submodule "Platforms/[platform]"]
       path = Platforms/[platform]
       url = git@bitbucket.org:jellyhaus/[platform].git
       branch = [branch]
   ```
   For Example:

   ```bash
   [submodule "Platforms/OpsFM"]
       path = Platforms/OpsF
       url = git@bitbucket.org:jellyhaus/ops-fm.git
       branch = [branch]
   ```
   For additional Platforms, append the template to the `gitmodules` file as needed.

   Restart VSCode for it to recognise the additional Repositories

## Step 2: Environment Configuration

Copy and configure your environment file:

```bash
cp .env.example .env
```

Update `.env` with these settings:

```dotenv
APP_ENV=local
APP_DEBUG=true
APP_URL=https://jellybean-local.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=8889
DB_DATABASE=jellybean
DB_USERNAME=root
DB_PASSWORD=root
```

## Step 3: Install PHP Dependencies
1. Configure Flux UI credentials:
    ```bash
    php84 /Applications/MAMP/bin/php/composer config http-basic.composer.fluxui.dev "YOUR_EMAIL" "YOUR_LICENSE_KEY"
    ```
2. Install dependencies using PHP:
    ```bash
    php84 /Applications/MAMP/bin/php/composer install
    ```
3. Generate application key:
    ```bash
    php84 artisan key:generate
    ```

## Step 4: Install Node Dependencies
```bash
npm install
```

## Step 5: Database Setup

### Create Database

Open MySQL in MAMP or via command line:

```bash
/Applications/MAMP/Library/bin/mysql -u root -p
```

Create the database:

```sql
CREATE DATABASE jellybean;
```

### Run Migrations

```bash
php84 artisan migrate
```

## Step 6: Configure MAMP

### Set Document Root

1. Open **MAMP**
2. Go to **Preferences** → **Web Server**
3. Set **Document Root** to: `/Users/markwilliamson/Sites/jellybean/public` (Or wherever you cloned jellybean)
1. Ensure PHP version is set to **8.4**
2. Click **OK** and restart servers

### Configure Hosts File

Add local domain to your hosts file:

```bash
sudo nano /etc/hosts
```

Add this line:

```bash
127.0.0.1  jellybean-local.com
```

Save and exit (Ctrl+O, Enter, Ctrl+X)

## Step 7: Access Application
Run `composer run dev`. This will:
- Update PHP and JavaScript libraries
- Install the latest playwright libraries (for automatic Browser testing)
- Run several Laravel development commands:
  - php artisan queue:listen (to process queues locally)
  - npm run dev (for JS/SCSS compilation, and live reload)
  - php artisan schedule:work (for scheduled commands)

- For real-time logging, open a new terminal tab/window and run `composer run logs`. This will tail the logs for:
  - Git (Pre-commit and Pre-push commands)
  - Laravel `laravel-[date].log`

## Common Commands

### PHP Commands (use php84 alias)

```bash
# Run JellyBean commands (These will help create files, and run any migrations for both JellyBean and Platforms)
php84 artisan jb

# Run artisan commands
php84 artisan list

# Clear caches
php84 artisan optimize:clear

# Rollback migrations (for migrations use `php artisan jb`)
php84 artisan migrate:rollback
```

## Troubleshooting

### "Access denied for user" Error

- Check database credentials in `.env`
- Verify MySQL is running in MAMP
- Ensure port is correct (default: 8889)

### "Class not found" Errors

```bash
php84 /Applications/MAMP/bin/php/composer dump-autoload
php84 artisan optimize:clear
```

### Permission Issues

```bash
chmod -R 775 storage bootstrap/cache
```

## Project Structure

```bash
jellybean/                 # Parent Laravel application
├── app/                   # Core application code
├── Platforms/
│   └── OpsFM/             # OpsFM module (symlink or copy)
│       ├── app/           # Module application code
│       ├── database/      # Module migrations
│       ├── routes/        # Module routes
│       └── resources/     # Module views/assets
├── public/                # Web root (MAMP document root)
├── storage/               # Logs, cache, uploads
│   └── app/
│       └── platform_statuses.json  # Enables OpsFM
└── .env                   # Environment configuration
```

## Development Workflow
### Working on Platforms
1. Make changes in the `Platform/[Platform]` directory
2. Changes are immediately reflected in JellyBean
3. Commit and push from the OpsFM directory

### Working on JellyBean Core
1. Make changes in the JellyBean directory
2. Test with Platforms enabled
3. Commit and push from JellyBean directory

### Git Hooks
When committing and pushing to JellyBean and platforms coding standards are applied to changes and testing is ran to make sure everything is clean and works as it should.

Logs can be found via `storage/logs/git-hooks.log`, but running `composer run logs` will tail these and the Laravel logs.

## Deployment
Both JellyBean and Platforms have Workflows tied to their repositories that run when pushes are made to the main branch on any repository. These workflows will:
1. Run coding standards on all files (issues should have been previously captured during previous commits and pushes)
2. Bump the version number with the following format `[year].[month].[monthly build]`.
3. Trigger Azure deployments repositories which:
   1. Pulls in JellyBean
   2. Pulls in the Platform
   3. Runs `composer install`, `npm install` and `npm run build`
   4. Zips the resulting files
   5. Uploads to Azure

## Notes
- **OpsFM is a Laravel Module** - it cannot run standalone
- **JellyBean is the parent application** - Platforms plug into it
- Always use `php84` alias for PHP commands to ensure PHP 8.4 compatibility
- The `public` directory must be the web root, not the project root
- Platform statuses are managed via (`storage/app/platform_statuses.json`). This should not be updated directly, instead use `php artisan module:enable [Platform]` or `php artisan module:enable [Platform]`
