<?php
function call($controller, $action)
{

    //print_r($controller);
    require_once('controllers/' . $controller . '_controller.php');
    switch ($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'identity':
            // we need the model to query the database later in the controller
            require_once('models/identity.php');
            require_once('models/school.php');
            require_once('models/address.php');
            require_once('models/teacher.php');
            require_once('models/studentContact.php');
            require_once('models/sclass.php');
            require_once('models/grade.php');
            require_once('models/student.php');
            $controller = new IdentityController();
            break;
        case 'school':
            require_once('models/school.php');
            $controller = new SchoolController();
            break;
        case 'student';
            require_once('models/student.php');
            $controller = new StudentController();
            break;
    }
    $controller->{$action}();
}

// we're adding an entry for the new controller and its actions
$controllers = array('identity' => ['home', 'listRecords'],
                     'school' => ['listRecords'],
                     'student' => ['listStudentContacts'],
                     'posts' => ['index', 'show']);
  if (array_key_exists($controller, $controllers)) {
      if (in_array($action, $controllers[$controller])) {
          call($controller, $action);
      } else {
          call('identity', 'home');
      }
  } else {
      call('pages', 'error');
  }
?>
