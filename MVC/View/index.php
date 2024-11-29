<?php

require_once __DIR__ . "/../Controller/studentController.php";

$controller = $_REQUEST['controller'] ?? 'not found';
$studentController = new studentController();

if ($controller === 'view') {
    $studentController->viewStudent();
} else if ($controller === 'insert') {
    $studentController->insertStudentForm();
} else if ($controller === 'update') {
    $studentController->updateStudent();
} else if ($controller === 'delete') {
    $studentController->deleteStudent();
} else if ($controller === 'search') {
    $studentController->searchStudentForm();
} else {
    die("404 Not Found");
}