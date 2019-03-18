# PCNTL

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require savin/pcntl
```

## Usage

```
$pcnl = PCNTL::create([SIGINT, SIGTERM, SIGHUP]);

while (true) {
    if ($pcnl->dispatch()->getLastSigno()) break;
}

echo $pcnl->getLastMessage();
```

```
$terminate = false;

$pcnl = PCNTL::create([SIGINT, SIGTERM], function($signal) use(&$terminate) {
    $terminate = $signal;
});

while (!$terminate) {
    $pcnl->dispatch();
}
```