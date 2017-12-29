<?php

function index($dbConnection)
{
    $query = 'SELECT id, last_name, first_name FROM student';
	$statement = $dbConnection->prepare($query);
	$statement->execute();
	$students = $statement->fetchAll(PDO::FETCH_ASSOC);

    $pageName = 'Students';

    include_once(TEMPLATES .'student/index.php');
}

function view($dbConnection)
{
    $studentId = getParam('studentId');
    $student = findById($dbConnection, $studentId);
    $pageName = 'Students';
    $panelHeader = 'Student Information';

    include_once(TEMPLATES . 'student/view.php');
}

function findById($dbConnection, $studentId)
{
    $query = 'SELECT id, last_name, first_name, date_of_birth, address FROM student WHERE id = :studentId';
	$statement = $dbConnection->prepare($query);
    $statement->bindParam(':studentId', $studentId);
	$statement->execute();
    
    return $statement->fetch(PDO::FETCH_ASSOC);    
}

function add($dbConnection)
{
    $lastName = postParam('lastName');
    $firstName = postParam('firstName');
    $dateOfBirth = postParam('dateOfBirth');
    $address = postParam('address');

    $query = 'INSERT INTO student(last_name, first_name, date_of_birth, address) VALUES(:lastName, :firstName, :dateOfBirth, :address)';
	$statement = $dbConnection->prepare($query);
    $statement->bindParam(':lastName', $lastName);
    $statement->bindParam(':firstName', $firstName);
    $statement->bindParam(':dateOfBirth', $dateOfBirth);
    $statement->bindParam(':address', $address);
	$statement->execute();
    $studentId = $dbConnection->lastInsertId();
    
    echo json_encode(['studentId' => $studentId]);
}

function edit($dbConnection)
{
    $studentId = getParam('studentId');
    $student = findById($dbConnection, $studentId);

    echo json_encode($student);
}

function update($dbConnection)
{
    $studentId = postParam('studentId');
    $lastName = postParam('lastName');
    $firstName = postParam('firstName');
    $dateOfBirth = postParam('dateOfBirth');
    $address = postParam('address');

    $query = 'UPDATE student SET last_name = :lastName, first_name = :firstName, date_of_birth = :dateOfBirth, address = :address WHERE id = :studentId';
	$statement = $dbConnection->prepare($query);
    $statement->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $statement->bindParam(':lastName', $lastName);
    $statement->bindParam(':firstName', $firstName);
    $statement->bindParam(':dateOfBirth', $dateOfBirth);
    $statement->bindParam(':address', $address);
    $statement->execute();
    $rowCount = $statement->rowCount();

    echo json_encode(['rowCount' => $rowCount]);
}

function delete($dbConnection)
{
    $studentId = getParam('studentId');

    $query = "DELETE FROM student WHERE id =:studentId";
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(':studentId', $studentId);
    $statement->execute();
    $rowCount = $statement->rowCount();

    echo json_encode(['rowCount' => $rowCount]);
}