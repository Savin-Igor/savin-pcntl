# PCNTL

Laravel package to work with the OS signals.

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