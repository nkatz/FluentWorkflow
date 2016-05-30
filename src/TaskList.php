<?php
/**
 * A class that implements a list of tasks as a doubly-linked list.
 * There are many methods that are overriden in order to allow custom functionality specific to a task list,
 * such as packing a set of rules along with the task to perform.
 *
 * For a full list of operations available, see:
 * http://php.net/manual/en/class.spldoublylinkedlist.php
 *
 * @author Noam Katz
 */

namespace FluentWorkflow;

use \SplDoublyLinkedList;


class TaskList extends SplDoublyLinkedList
{


    /**
     * TaskList constructor.
     */
    public function __construct()
    {
        // Define the list order as First In First Out and that the iterator should keep all elements it sees
        $this->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO| SplDoublyLinkedList::IT_MODE_KEEP);
    }

    public function push($task)
    {
        $packedTask = new \stdClass();
        $packedTask->task = $task;
        $packedTask->rules = $task->rules();

        parent::push($packedTask);
    }

    public function add($index, $task)
    {
        $packedTask = new \stdClass();
        $packedTask->task = $task;
        $packedTask->rules = $task->rules();

        parent::add($index, $packedTask);
    }

    public function listAll()
    {
        $str = '';

        for ($this->rewind(); $this->valid(); $this->next()) {
            $str .= $this->current()->task . ', ' . 'key: ' . $this->key() . PHP_EOL;
        }

        return $str;
    }

}