<?php
//get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', 
        FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = array();
    
    // add some hard-coded starting values to make testing easier
    $task_list[] = 'Laundry';
    $task_list[] = 'Clean Room';
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//process
switch( $action ) {
    case 'Add ToDo':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new todo cannot be empty.';
        } else {
            // $task_list[] = $new_task;
	       array_push($task_list, $new_task);

        }
        break;
    case 'Delete ToDo':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The todo cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
        break;

    case 'Edit ToDo':
 $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
         if ($task_index === NULL || $task_index === FALSE) {
	             $errors[] = 'The todo cannot be modified.';
		             } else {
			                 $task_to_modify =
					 $task_list[$task_index];
					         }
						         break;


    case 'Save Changes':
  $i = filter_input(INPUT_POST, 'modifiedtaskid', FILTER_VALIDATE_INT);
          $modified_task = filter_input(INPUT_POST, 'modifiedtask');
	          if (empty($modified_task)) {
		              $errors[] = 'The modified todo cannot be empty.';
			              } elseif($i === NULL || $i === FALSE) {
				                  $errors[] = 'The todo cannot
						  be modified.';        
						          } else {
							              $task_list[$i]
								      =
								      $modified_task;
								                  $modified_task
										  =
										  '';
										          }
											          break;
}

include('task_list.php');
?>
