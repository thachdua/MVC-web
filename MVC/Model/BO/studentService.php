<?php
require_once __DIR__ . "/../BEAN/student.php";
require_once __DIR__ . "/../DAO/dbConnect.php";

class studentService
{
    function getAllStudents(): array
    {
        $dbConnect = new dbConnect();
        $resultSet = $dbConnect->executeQuery("SELECT * FROM students");
        $students = array();
        if ($resultSet instanceof mysqli_result) {
            if ($resultSet->num_rows > 0) {
                while ($row = $resultSet->fetch_assoc()) {
                    $students[] = new student($row['id'], $row['name'], $row['age'], $row['university']);
                }
            }
        }
        return $students;
    }

    function getStudent($id): ?student
    {
        $dbConnect = new dbConnect();
        $resultSet = $dbConnect->executeQuery("SELECT * FROM students WHERE id = '$id'");
        $student = null;
        if ($resultSet instanceof mysqli_result) {
            if ($resultSet->num_rows > 0) {
                if ($row = $resultSet->fetch_assoc()) {
                    $student = new student($row['id'], $row['name'], $row['age'], $row['university']);
                }
            }
        }
        return $student;
    }

    public function getStudents($list_id): array
    {
        $dbConnect = new dbConnect();
        $query = "SELECT * FROM students WHERE id IN(";
        foreach ($list_id as $id) {
            $query .= "'$id',";
        }
        $query[-1] = ")";

        $resultSet = $dbConnect->executeQuery($query);
        $students = array();
        if ($resultSet instanceof mysqli_result) {
            if ($resultSet->num_rows > 0) {
                while ($row = $resultSet->fetch_assoc()) {
                    $students[] = new student($row['id'], $row['name'], $row['age'], $row['university']);
                }
            }
        }
        return $students;
    }

    public function insertStudent($id, $name, $age, $university): void
    {
        $dbConnect = new dbConnect();
        $dbConnect->executeUpdate("INSERT INTO students(id, name, age, university) VALUES('$id', '$name', '$age', '$university')");
    }

    public function insertStudents(array $list_id, array $list_name, array $list_age, array $list_university): void
    {
        $dbConnect = new dbConnect();
        $n = count($list_id);
        for ($it = 0; $it < $n; $it++) {
            $dbConnect->executeUpdate("INSERT INTO students(id, name, age, university) VALUES('$list_id[$it]', '$list_name[$it]', '$list_age[$it]', '$list_university[$it]')");
        }
    }

    public function updateStudent($id, $name, $age, $university): void
    {
        $dbConnect = new dbConnect();
        $dbConnect->executeUpdate("UPDATE students SET name='$name', age='$age', university='$university' where id='$id')");
    }

    public function updateStudents($list_id, $list_name, $list_age, $list_university): void
    {
        $dbConnect = new dbConnect();
        $n = count($list_id);
        for ($it = 0; $it < $n; $it++) {
            $dbConnect->executeUpdate("UPDATE students SET name='$list_name[$it]', age='$list_age[$it]', university='$list_university[$it]' where id='$list_id[$it]'");
        }
    }

    public function deleteStudent($id): void
    {
        $dbConnect = new dbConnect();
        $dbConnect->executeUpdate("DELETE FROM students WHERE id = '$id'");
    }

    public function deleteStudents($list_id): void
    {
        $dbConnect = new dbConnect();
        $sql = "DELETE FROM students WHERE id in (";

        foreach ($list_id as $id) {
            $sql .= "'$id',";
        }
        $sql[-1] = ")";
        $dbConnect->executeUpdate($sql);
    }

    public function searchStudents($field, $value): array
    {
        $dbConnect = new dbConnect();
        $resultSet = $dbConnect->executeQuery("SELECT * FROM students WHERE $field = '$value'");
        $students = array();
        if ($resultSet instanceof mysqli_result) {
            if ($resultSet->num_rows > 0) {
                while ($row = $resultSet->fetch_assoc()) {
                    $students[] = new student($row['id'], $row['name'], $row['age'], $row['university']);
                }
            }
        }
        return $students;
    }
}