<?php
  function call($controller, $action) {
    //print_r($controller);
    require_once('controllers/' . $controller . '_controller.php');
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'scripture':
        // we need the model to query the database later in the controller
        require_once('models/scripture.php');
        require_once('models/topic.php');
        $controller = new ScriptureController();
      break;
    }
    $controller->{ $action }();
  }
  // we're adding an entry for the new controller and its actions
  $controllers = array('scripture' => ['home', 'post'],
                       'posts' => ['index', 'show']);
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('scripture', 'home');
    }
  } else {
    call('pages', 'error');
  }
?>
