<?php
   class IdentityController {
      public function home() {
         $address = Address::findByIdentityId(1);
         $schools = School::all(0,50);
         $teachers = Teacher::findBySchoolId(1);
         $studentContacts = StudentContact::findByStudentId(1);
         $classes = Sclass::findByTeacherId(1);
         $student = Student::findById(1);
         require_once('views/identity/home.php');
      }

      public function listRecords() {
         $start = 0;
         $number = 50;
         $records = Identity::rowCount();
         if(isset($_POST['rStart']))
            $start = $_POST['rStart'];
         if(isset($_POST['rNumber']))
            $number = $_POST['rNumber'];
         $identities = Identity::all($start, $records);
         require_once('views/identity/list.php');
      }

       public function updateImage() {
           require_once('helpers/upload.php');
           $code = '';
           if (isset($_POST['id']) && isset($_POST['path'])) {
               $id = intval($_POST['id']);
               $handle = new upload($_FILES['image_field']);
               if ($handle->uploaded) {
                   $handle->file_new_name_body   = $id;
                   $handle->image_resize         = true;
                   $handle->image_x              = 100;
                   $handle->image_ratio_y        = true;
                   $handle->file_overwrite       = true;
                   $handle->process($_SERVER['DOCUMENT_ROOT'] . '/EduDB/imageUploads/' );
                   if ($handle->processed) {
                       $code = 'i1'; // Success
                       $handle->clean();
                   } else {
                       echo 'error : ' . $handle->error;
                       $code = 'i0'; // Failure
                   }
               }
               Identity::updateImage($id, '/EduDB/imageUploads/'.$handle->file_dst_name);
           }
           header("Location: " . $_POST['path'].'/'.$code);
       }

   }

?>
