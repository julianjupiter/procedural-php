<?php

function index($dbConnection)
{
    $query = 'SELECT id, last_name, first_Name FROM student';
	$statement = $dbConnection->prepare($query);
	$statement->execute();
	$students = $statement->fetchAll(PDO::FETCH_ASSOC);

    include_once(VIEWS . 'student/index.php');
}

function view($dbConnection)
{
    $id = getParam('id');
    $query = 'SELECT id, last_name, first_name FROM student WHERE id = :id';
	$statement = $dbConnection->prepare($query);
    $statement->bindParam(':id', $id);
	$statement->execute();
    $student = $statement->fetch();

    include_once(VIEWS . 'student/view.php');
}

function create($dbConnection)
{
    $query = 'INSERT INTO student(last_name, first_name) VALUES(:lastName, :firstName)';
	$statement = $dbConnection->prepare($query);
    $statement->bindParam(':lastName', $data['lastName']);
    $statement->bindParam(':firstName', $data['firstName']);
	$statement->execute();

	return $dbConnection->lastInsertId();
}

function edit($dbConnection)
{
    $id = getParam('id');
    echo $id;
}

function update($dbConnection)
{
    $id = postParam('id');
    $lastName = postParam('lastName');
    $firstName = postParam('firstName');

    $query = 'UPDATE student SET last_name = :lastName, first_name = :firstName WHERE id = :id)';
	$statement = $dbConnection->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':lastName', $lastName);
    $statement->bindParam(':firstName', $firstName);
	$statement->execute();

    return $statement->rowCount();
}

function delete($dbConnection)
{
    $id = getParam('id');

    $query = "DELETE FROM thesis WHERE id =:id";
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    
    return $statement->rowCount();
}