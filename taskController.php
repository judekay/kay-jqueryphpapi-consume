<?php

/**
 * Created by PhpStorm.
 * User: Judekayode
 * Date: 5/9/2016
 * Time: 4:08 PM
 */
class taskController
{
    private $taskModel;

    function __construct()
    {
        $this->taskModel = new taskModel();

    }

    function addnewtask($task)
    {
        $newtask = $this->taskModel->addTask($task);
        if($newtask)
        {
            return true;
        }
        else{
            return false;
        }

    }

    function getalltask()
    {
        $gettask = $this->taskModel->getTask();
        if($gettask)
        {
            return $gettask;
        }
        else{
            return false;
        }
    }

    function deleteoldtask($task_id)
    {
        $updatetask = $this->taskModel->deleteTask($task_id);
        if($updatetask){
            return true;
        }
        else{
            return false;
        }
    }

}