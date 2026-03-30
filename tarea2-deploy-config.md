# Railway Deploy Steps (Laravel)

Use this checklist to deploy this branch correctly on Railway.

## 1) Connect the Repository and Branch

1. Open Railway and create/select your project.
2. Connect the GitHub repository.
3. Select the branch you want to deploy.
4. Confirm auto-deploy is enabled for new commits.

## 2) Set Required Environment Variables

In Railway service settings, add/update these variables:

1. `APP_ENV=production`
2. `APP_DEBUG=false`
3. `APP_KEY=<your-generated-app-key>`
4. `APP_URL=https://<your-railway-domain>`
5. `LOG_CHANNEL=stack`
6. `LOG_LEVEL=info`

If using a Railway database plugin, also set:

1. `DB_CONNECTION` (for example: `pgsql` or `mysql`)
2. `DB_HOST`
3. `DB_PORT`
4. `DB_DATABASE`
5. `DB_USERNAME`
6. `DB_PASSWORD`

Note: this project defaults to SQLite locally. On Railway, use the managed database variables above.

## 3) Build and Start Commands

Set these in Railway (or confirm they match your current configuration):

1. Build command:

```bash
composer install --no-dev --optimize-autoloader
```

2. Start command:

```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

## 4) Run Migrations After Deploy

This branch uses relational tables for authors, publishers, and books, so migrations are required.

After a successful deploy, run in Railway service shell:

```bash
php artisan migrate --force
```

If you want demo data in production too, run:

```bash
php artisan db:seed --force
```

## 5) Verify Application Health

1. Open `/` and confirm Home page loads.
2. Open `/authors`, `/publishers`, and `/books`.
3. Create one record in each section and confirm relations work.
4. Check Railway logs for errors.

## 6) Important Config Cleanup

Your `nixpacks.toml` currently appears to include extra non-TOML text after the start command. Clean that file before future deploys to avoid parser/build issues.

Expected minimal `nixpacks.toml` structure:

```toml
[phases.setup]
nixPkgs = ["php82", "php82Extensions.mbstring", "php82Extensions.xml", "php82Extensions.tokenizer", "php82Extensions.pdo"]

[phases.install]
cmds = ["composer install --no-dev --optimize-autoloader"]

[start]
cmd = "php artisan serve --host=0.0.0.0 --port=$PORT"
```

## 7) Quick Re-Deploy Flow for New Commits

1. Push commit to the connected branch.
2. Wait for Railway auto-deploy.
3. Run migrations if schema changed.
4. Validate key routes.
