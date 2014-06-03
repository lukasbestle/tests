<?php

include('bootstrap.php');

// start the cms
echo kirby::start(array(
  'root.content' => root('test.content'),
  'root.site'    => root('test.site')
));