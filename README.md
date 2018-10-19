Clara Event
===============

Event manager with full calendar for Clara.

## Installation

```php
composer require ceddyg/clara-event
```

Add to your providers in 'config/app.php'
```php
CeddyG\ClaraEvent\EventServiceProvider::class,
```

Then to publish the files.
```php
php artisan vendor:publish --provider="CeddyG\ClaraEvent\EventServiceProvider"
```
