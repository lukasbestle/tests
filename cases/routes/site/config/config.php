<?php

c::set('routes', array(
  array(
    'pattern' => 'projects/old-project-url-for-project-a',
    'action'  => function() {
      go('projects/project-a');
    }
  ),
  array(
    'pattern' => 'blog/archive/(:num)/(:num?)/(:num?)',
    'action'  => function($year, $month = null, $day = null) {
      return array('blog/archive', array(
        'year'  => $year,
        'month' => $month,
        'day'   => $day
      ));
    }
  )
));