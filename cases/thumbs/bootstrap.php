<?php

// include the kirby bootstrapper file
require_once(__DIR__ . '/../../kirby/bootstrap.php');

root('test',          __DIR__);
root('test.content',  __DIR__ . DS . 'content');
root('test.site',     __DIR__ . DS . 'site');
root('test.thumbs.a', __DIR__ . DS . 'thumbs-a');
root('test.thumbs.b', __DIR__ . DS . 'thumbs-b');