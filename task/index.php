<?php
/**
 * Created by PhpStorm.
 * User: Judekayode
 * Date: 5/9/2016
 * Time: 4:23 PM
 */
include_once('../taskModel.php');
include_once('../taskController.php');

if(isset($_GET['a'])){

    if($_GET['a'] == 'tasks')
    {
        $tasks = new taskController();
        $gettask = $tasks->getalltask();
        if(!empty($gettask) && count($gettask))
        {
            echo

            json_encode([
                'status'=> true,
                'message'=> 'task fetched successfully',
                'data'=> $gettask
            ]);

        }
        else{
            echo json_encode([
                'status'=> false,
                'message'=>'tasks could not be fetched',
                'data'=> null
            ]);
        }


    }
    elseif($_GET['a'] == 'addtask')
    {
        $tasks = new taskController();

        $addtask = $tasks->addnewtask($_POST['task']);
        if($addtask == true)
        {
            echo json_encode([
               'status'=>true,
                'message'=>'new task added successfully',
                'data'=> null
            ]);
        }
        else{
            echo json_encode([
               'status'=>false,
                'message'=> 'new task could not be added',
                'data'=>null
            ]);

        }

    }
    elseif($_GET['a'] == 'deletetask')
    {
        $tasks = new taskController();

        $remtask = $tasks->deleteoldtask($_POST[task_id]);
        if($remtask == true)
        {
            echo json_encode([
                'status' => true,
                'message' => 'task removed successfully',
                'data'=>null
            ]);
        }
        else{
            echo json_encode([
               'status'=> false,
                'message'=> 'task could not be removed',
                'data'=> null
            ]);
        }

    }


}