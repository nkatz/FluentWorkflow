<?php
/**
 * Represents a workflow, the highest level object and a basic state machine.
 *
 * @author Noam Katz
 */

namespace FluentWorkflow;


class Workflow
{

    /**
     * @var TaskList A linked list of all tasks that this workflow should execute
     */
    private $taskList;

    /**
     * @var Task the current task that the workflow is executing
     */
    private $currentTask;

    /**
     * @var int A unique ID identifying the position of the current task in the flow
     */
    private $currentTaskIndex;

    /**
     * Workflow constructor.
     * @param TaskList $taskList
     * @param int $currentTaskIndex
     */
    public function __construct(TaskList $taskList = null, $currentTaskIndex = null)
    {
        if ($taskList) {
            $this->taskList = $taskList;
        }else {
            $this->taskList = new TaskList();
        }

        $this->currentTaskIndex = $currentTaskIndex;
    }

    /****************************************************
     *
     * Basic plumbing to handle adding, removing and listing
     * Tasks that will be executed by the workflow.
     *
     ****************************************************/


    /**
     * Inserts a new task into the workflow queue.
     * If no position is specified, the task is added to the top of the queue
     *
     * @param Task $task
     * @param int $index
     * @return int
     */
    private function _addNewTask(Task $task, $index = null)
    {
        if ($this->taskList->isEmpty())
        {
            $this->taskList->push($task);
        }
        elseif ($index) { $this->taskList->add($task,$index); }
        else { $this->taskList->push($task); }

        return $this->taskList->key();

    }

    /**
     * @param $index the index of the task to remove from the workflow
     */
    private function _removeTask($index)
    {
        $this->taskList->offsetUnset($index);
    }

    public function listAllTasks()
    {
        return $this->taskList->listAll();
    }



    /****************************************************
     *
     * The following methods are designed to make the workflow
     * as readable as possible. Example:
     *
     * $workflow
     *    ->startWith($firstTask)
     *    ->then($secondTask)
     *    ->then($thirdTask)
     *    ->endWith($lastTask);
     *
     ****************************************************/

    /**
     * Add a new task to the BEGINNING of the workflow
     * 
     * @param Task $task
     * @return Workflow
     */
    public function startWith(Task $task)
    {
        $this->_addNewTask($task, 0);

        return $this;
    }

    /**
     * Add a new task as the next step
     *
     * @param Task $task
     * @return Workflow
     */
    public function then(Task $task)
    {
        $this->_addNewTask($task);

        return $this;
    }

    /**
     * Add a new task to the END of the workflow.
     *
     * @param Task $task
     * @return $this
     */
    public function endWith(Task $task)
    {
        $this->_addNewTask($task);

        return $this;
    }


}