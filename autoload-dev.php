<?php

// Override Composer packages with the files from the repository. This is very
// helpful in development, so you can test without having to publish a bunch of
// package versions.

require __DIR__.'/vendor/autoload.php';

(function () {
  $classMap = [];
  foreach (glob(__DIR__.'/server/src/Drivers/*.php') as $file) {
    $classMap['Nymph\\Drivers\\'.basename($file, '.php')] = $file;
  }
  foreach (glob(__DIR__.'/server/src/Exceptions/*.php') as $file) {
    $classMap['Nymph\\Exceptions\\'.basename($file, '.php')] = $file;
  }
  foreach (glob(__DIR__.'/server/src/*.php') as $file) {
    $classMap['Nymph\\'.basename($file, '.php')] = $file;
  }
  foreach (glob(__DIR__.'/pubsub/src/*.php') as $file) {
    $classMap['Nymph\\PubSub\\'.basename($file, '.php')] = $file;
  }
  spl_autoload_register(function ($className) use ($classMap) {
    if (isset($classMap[$className]))
      include $classMap[$className];
  }, true, true);
})();
