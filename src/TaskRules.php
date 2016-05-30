<?php
/**
 * Class to encapsulate workflow rules for a specific task in the workflow.
 * Every task should have TaskRules associated with it, although Tasks can
 * rely on default values if missing.
 *
 * @author Noam Katz
 */

namespace FluentWorkflow;


class TaskRules
{
    /**\
     * @var array string list of tasks which are allowed from the current task (by name)
     */
    protected $allowableNextTasks = [];

    /**
     * @var int unix timestamp to begin processing the task
     */
    protected $startTimestamp;


    /**
     * @var int unix timestamp of when the task must be complete by before failure is assumed
     */
    protected $completeByTimestamp;

    /**
     * @var bool whether the task is mandatory to complete successfully. If false, workflow will not halt on failure.
     */
    protected $mandatorySuccess = true;

    /**
     * @var int priority from 1-5 to be used for logging, worker logistics, etc
     */
    protected $priority = 3;

    /**
     * @var int the number of seconds the task can execute before failure is assumed
     */
    protected $maxExecutionTime;

    /**
     * @var int the minimum number of seconds that can elapse between task heartbeats before failure is assumed
     */
    protected $minHeartBeatTime = 0;

    /**
     * @var bool whether a human must sign off on the task before it is processed
     */
    protected $requireSignalToStart = true;

    /**
     * @var bool whether a human must sign off on the task before it is considered complete
     */
    protected $requireSignalToComplete = true;

    /**
     * @return array
     */
    public function getAllowableNextTasks()
    {
        return $this->allowableNextTasks;
    }

    /**
     * @param array $allowableNextTasks
     * @return TaskRules
     */
    public function setAllowableNextTasks($allowableNextTasks)
    {
        $this->allowableNextTasks = $allowableNextTasks;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartTimestamp()
    {
        return $this->startTimestamp;
    }

    /**
     * @param int $startTimestamp
     * @return TaskRules
     */
    public function setStartTimestamp($startTimestamp)
    {
        $this->startTimestamp = $startTimestamp;
        return $this;
    }

    /**
     * @return int
     */
    public function getCompleteByTimestamp()
    {
        return $this->completeByTimestamp;
    }

    /**
     * @param int $completeByTimestamp
     * @return TaskRules
     */
    public function setCompleteByTimestamp($completeByTimestamp)
    {
        $this->completeByTimestamp = $completeByTimestamp;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isMandatorySuccess()
    {
        return $this->mandatorySuccess;
    }

    /**
     * @param boolean $mandatorySuccess
     * @return TaskRules
     */
    public function setMandatorySuccess($mandatorySuccess)
    {
        $this->mandatorySuccess = $mandatorySuccess;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return TaskRules
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxExecutionTime()
    {
        return $this->maxExecutionTime;
    }

    /**
     * @param int $maxExecutionTime
     * @return TaskRules
     */
    public function setMaxExecutionTime($maxExecutionTime)
    {
        $this->maxExecutionTime = $maxExecutionTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinHeartBeatTime()
    {
        return $this->minHeartBeatTime;
    }

    /**
     * @param int $minHeartBeatTime
     * @return TaskRules
     */
    public function setMinHeartBeatTime($minHeartBeatTime)
    {
        $this->minHeartBeatTime = $minHeartBeatTime;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequireSignalToStart()
    {
        return $this->requireSignalToStart;
    }

    /**
     * @param boolean $requireSignalToStart
     * @return TaskRules
     */
    public function setRequireSignalToStart($requireSignalToStart)
    {
        $this->requireSignalToStart = $requireSignalToStart;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequireSignalToComplete()
    {
        return $this->requireSignalToComplete;
    }

    /**
     * @param boolean $requireSignalToComplete
     * @return TaskRules
     */
    public function setRequireSignalToComplete($requireSignalToComplete)
    {
        $this->requireSignalToComplete = $requireSignalToComplete;
        return $this;
    }


}