# Installation
1. Insert into composer.json
```json
"extra": {
    "laravel": {
        "providers": [
            "Fuse\\FuseServiceProvider"
        ]
    }
}
```

# To Do:
- [ ] Migrate files to Fuse
  - [ ] Stubs - Copy as neccessery
  - [ ] Rename `namespace App\` to `namespace Fuse\`
  - [ ] Rename `use App\` to `use Fuse\`
- [ ] Remove Module/Platform references
- [ ] Libray Composer installs
- [ ] Migrate to Livewire 4
  - [ ] app\Livewire
  - [ ] resources/livewire
- [ ] VSCode snippets - File in project to import from C4/Fuse
- [ ] Run coding standards on everything
  - [ ] Rector
  - [ ] Pint
- [ ] Contrib
  - [ ] Update scripts
  - [ ] Use scripts
- [ ] Composer Install Scripts
  - [ ] Install
    - [ ] Replace all config files with common overrides. E.g.
      - [ ] App Name
      - [ ] Database Config
      - [ ] Logging
      - [ ] Extend controller from Fuse Controller
    - [ ] Remove all route files
    - [ ] Remove default database migrations
  - [ ] Update
    - [ ] Install any libraries
    - [ ] Update any files
      - [ ] Git hooks
      - [ ] GitHub actions
- [ ] Update documentation
