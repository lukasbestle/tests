<?php

foreach(page('projects')->children()->sortBy('title', 'asc') as $item) {
  dump($item->title()->toString());
}

