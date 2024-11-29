<?php

require_once __DIR__ . "/../Model/BO/studentService.php";

class studentController
{
    function viewStudent(): void
    {
        $students = (new studentService())->getAllStudents();
        include_once __DIR__ . "/../View/viewStudent.html";
    }

    function insertStudentForm(): void
    {
        include_once __DIR__ . "/../View/insertStudentForm.html";
    }

    function updateStudentForm($list_id): void
    {
        $students = (new studentService())->getStudents($list_id);
        include_once __DIR__ . "/../View/updateStudentForm.html";
    }

    function updateStudent(): void
    {
        $students = (new studentService())->getAllStudents();
        include_once __DIR__ . "/../View/updateStudent.html";
    }


    function deleteStudentForm($list_id): void
    {
        $students = (new studentService())->getStudents($list_id);

    }

    function deleteStudent(): void
    {
        $students = (new studentService())->getAllStudents();
        include_once __DIR__ . "/../View/deleteStudent.html";
    }

    function searchStudentForm(): void
    {
        include_once __DIR__ . "/../View/searchStudentForm.html";
    }

    public function searchStudents($field, $value): void
    {
        $students = (new studentService())->searchStudents($field, $value);
        include_once __DIR__ . "/../View/viewStudent.html";
    }
}

if (isset($_REQUEST['operation'])) {
    $operation = $_REQUEST['operation'];
    $studentService = new studentService();
    $studentController = new studentController();
    if ($operation === 'insert') {
        $list_id = $_REQUEST['id'] ?? array();
        $list_name = $_REQUEST['name'] ?? array();
        $list_age = $_REQUEST['age'] ?? array();
        $list_university = $_REQUEST['university'] ?? array();
        $studentService->insertStudents($list_id, $list_name, $list_age, $list_university);
        header("Location: /../MVC/View/index.php?controller=view");
    } else if ($operation === 'update') {
        $mode = $_REQUEST['mode'] ?? 'checkbox';
        if ($mode === 'checkbox') {
            $studentController->updateStudentForm($_REQUEST['id'] ?? array());
        } else if ($mode === 'submit') {
            $list_id = $_REQUEST['id'] ?? array();
            $list_name = $_REQUEST['name'] ?? array();
            $list_age = $_REQUEST['age'] ?? array();
            $list_university = $_REQUEST['university'] ?? array();
            $studentService->updateStudents($list_id, $list_name, $list_age, $list_university);
            header("Location: /../MVC/View/index.php?controller=view");
        }
    } else if ($operation === 'delete') {
        $list_id = $_REQUEST['id'] ?? array();
        $studentService->deleteStudents($list_id);
        header("Location: /../MVC/View/index.php?controller=view");
    } else if ($operation === 'search') {
        $studentController->searchStudents($_REQUEST['field'] ?? "", $_REQUEST['value'] ?? "");
    }
}