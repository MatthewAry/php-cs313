<?php

/**
 * Created by PhpStorm.
 * User: MatthewAry
 * Date: 2/10/2016
 * Time: 11:51 AM
 */
class SchoolController
{
    public function listRecords()
    {
        $start = 0;
        $number = 50;
        if(isset($_POST['rStart']))
            $start = $_POST['rStart'];
        if(isset($_POST['rNumber']))
            $number = $_POST['rNumber'];
        else
            $number = School::rowCount();
        $schools = School::all($start, $number);
        require_once('views/school/list.php');
    }
}