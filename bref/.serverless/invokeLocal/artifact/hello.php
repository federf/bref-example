<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

lambda(function ($event) {
    return 'Hello ' . ($event['name'] ?? 'world');
});

// return function ($event) {
//     // return 'Hello ' . ($event['name'] ?? 'world :D');
//     return 'Hello ' . ($event['name'] ?? ' darkness') . ' my old friend';
// };
