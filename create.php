<?php 

require "cfg/db_connect.php";
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskTitle = htmlspecialchars($_POST['title']);
    $taskDescription = htmlspecialchars($_POST['description']);
    $taskDeadline = htmlspecialchars($_POST['deadline']);
    $taskPriority = htmlspecialchars($_POST['priority']);

    $sql = 'INSERT INTO taskManage (taskTitle, taskDescription, taskDeadline, taskPriority)
     VALUES (:taskTitle, :taskDescription, :taskDeadline, :taskPriority)';

    $stmt = $pdo->prepare($sql);

    $params = [
        ':taskTitle' => $taskTitle,
        ':taskDescription' => $taskDescription,
        ':taskDeadline' => $taskDeadline,
        ':taskPriority' => $taskPriority
    ];

    if ($stmt->execute($params)) {
        echo json_encode(['message'=> 'Task created successfully.']);
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
    
}
