<?php
class Db {
   private static $instance = NULL;

   private function __construct() {}

   private function __clone() {}

   public static function getInstance() {
      if (!isset(self::$instance)) { // Singleton
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         if (getenv('OPENSHIFT_MYSQL_DB_HOST')) {
            define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
            define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
            self::$instance = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.'dbname=schoolapp',
                                   'schoolapp', 'forest', $pdo_options);
         } else {
            self::$instance = new PDO('mysql:host=localhost;dbname=schoolapp',
                                   'schoolapp', 'forest', $pdo_options);
         }
      }
      return self::$instance;
   }
}
