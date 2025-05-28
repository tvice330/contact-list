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
    "tvice/contact-list": "dev-main"
  }
php artisan vendor:publish --provider="Tvice\ContactList\Providers\ContactListServiceProvider"
php artisan migrate
cd vendor/tvicecontact-list
npm install
npm run build
cd-
php artisan vendor:publish --all
php artisan db:seed --class=ContactSeeder
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
