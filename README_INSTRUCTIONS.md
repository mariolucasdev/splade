# Jetstream Starter Kit

```php
laravel new example-app

cd example-app

composer require protonemedia/laravel-splade-jetstream

php artisan jetstream:install --teams --api --verification
```

O seguinte erro foi encontrado ao tentar iniciar a instalação:

```
failed to load config from C:\laragon\www\splade\vite.config.js
error when starting dev server:
TypeError: laravel is not a function
    at file:///C:/laragon/www/splade/vite.config.js.timestamp-1684024886625.mjs:7:5
    at ModuleJob.run (node:internal/modules/esm/module_job:194:25)
```

A correção foi remover no package.json:

```
type: "module"
```

# Navegação e Rotas
