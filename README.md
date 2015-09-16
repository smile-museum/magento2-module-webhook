**Note:** This is alpha software and not to be used in production until v1.0.0

# Webhooks for Magento 2

This module provides webhooks for Magento 2 events. More to come soon! Contributors welcome!

## Getting Started

Install via composer
```
composer require sweettooth/magento2-module-webhook
```

Add `SweetTooth_Webhook` to your `app/etc/config.php`
```php
<?php
return array (
  'modules' => 
  array (
    //
    // Bunch of other modules
    // 
    'SweetTooth_Webhook' => 1,
  ),
);
```

Run database migrations
```
php bin/magento setup:upgrade
```

## Available Webhooks

Available now
- Customer updated
- Customer deleted

TODO
- Customer created
- Order created
- Order updated
- Order deleted
- Product created
- Product updated
- Product deleted
- etc

## Contributing

Submit a pull request!