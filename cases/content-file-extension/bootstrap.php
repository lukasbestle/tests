<?php

// include the kirby bootstrapper file
require_once(__DIR__ . '/../../kirby/bootstrap.php');

root('test',             __DIR__);
root('test.content.md',  __DIR__ . DS . 'content-md');
root('test.content.txt', __DIR__ . DS . 'content-txt');
root('test.site',        __DIR__ . DS . 'site');