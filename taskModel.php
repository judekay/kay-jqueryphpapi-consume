<?php
/**
 * Created by PhpStorm.
 * User: Judekayode
 * Date: 5/9/2016
 * Time: 3:48 PM
 */
class taskModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=angular_task;charset=utf8mb4', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }


    function getTask()
    {
        $stmt = $this->db->query("SELECT * FROM tasks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function addTask($task)
    {
        $query = "INSERT INTO tasks (task,created_at, status)VALUES (:task,NOW(), 1)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task', $task);
        return $stmt->execute();
    }
    function deleteTask($task_id)
    {
        $stmt = $this->db->query("UPDATE tasks SET status_id = 0 WHERE id = :task_id");
        $stmt->bindParam(':task_id', $task_id);
        return $stmt->execute();
    }




}