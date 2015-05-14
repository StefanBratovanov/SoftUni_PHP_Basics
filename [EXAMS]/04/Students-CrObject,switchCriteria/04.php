<?php

$column = $_GET["column"];
$order = $_GET["order"];
$students = $_GET["students"];

$lines = preg_split("/[\r\n]+/", $students, -1, PREG_SPLIT_NO_EMPTY);

$id = 1;

$students = [];
foreach ($lines as $line) {
    $info = explode(", ",$line);

    $name = $info[0];
    $mail =  $info[1];
    $type =  $info[2];
    $grade =  intval($info[3]);
    $id = intval($id);

    $student = [
        "id" => $id,
        "name" => $name,
        "mail" => $mail,
        "type" => $type,
        "grade" =>$grade
    ];

    $id++;

    $students[] = $student;
}

//var_dump($students);
switch ($column) {
    case("id"):
        usort($students, 'sortByID');
        break;
    case("username"):
        usort($students, 'sortByName');
        break;
    case("result"):
        usort($students, 'sortByResult');
        break;
}

function sortByID($student1, $student2)
{
    global $order;
    if ($order === "ascending") {
        return $student1["id"] > $student2["id"] ? 1 : -1;
    } else {
        return $student1["id"] < $student2["id"] ? 1 : -1;
    }
}

function sortByResult($student1, $student2)
{
    global $order;
    $result = $student1["grade"] - $student2["grade"];
    if ($order === "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        if ($order === "ascending") {
            return $student1["id"] > $student2["id"] ? 1 : -1;
        } else {
            return $student1["id"] < $student2["id"] ? 1 : -1;
        }
    }

    return $result;
}

function sortByName($student1, $student2)
{
    global $order;
    $result = strcmp($student1["name"], $student2["name"]);
    if ($order === "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        if ($order === "ascending") {
            return $student1["id"] > $student2["id"] ? 1 : -1;
        } else {
            return $student1["id"] < $student2["id"] ? 1 : -1;
        }
    }

    return $result;
}
//var_dump($students);

$output = "<table><thead><tr><th>Id</th><th>Username</th><th>Email</th><th>Type</th><th>Result</th></tr></thead>";
foreach ($students as $student) {
    $output.= "<tr>";
    $output.= "<td>".htmlspecialchars($student["id"])."</td>";
    $output.= "<td>".htmlspecialchars($student["name"])."</td>";
    $output.= "<td>".htmlspecialchars($student["mail"])."</td>";
    $output.= "<td>".htmlspecialchars($student["type"])."</td>";
    $output.= "<td>".htmlspecialchars($student["grade"])."</td>";
    $output.= "</tr>";
}

$output .= "</table>";
echo $output;