## Installation

You can install the package via composer:

```bash
in composer.json
"repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/tvice330/contact-list"
    }
  ],
  "require": {
    "tvice330/contact-list": "dev-main"
  }
php artisan vendor:publish --provider="Tvice\ContactList\Providers\ContactListServiceProvider"
php artisan vendor:publish --all
php artisan migrate
php artisan db:seed --class="Tvice\\ContactList\\Database\\Seeders\\ContactSeeder"
cd vendor/tvice330/contact-list
npm install
npm run build
```

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

## License

The Apache License 2. Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
