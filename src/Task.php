<?php
/**
 * A single task that can be executed in the workflow
 *
 * @author Noam Katz
 */

namespace FluentWorkflow;

class Task
{
    /**
     *
     * @var string
     */
    protected $name = '';

    /**
     * @var TaskRules
     */
    protected $rules;

    /**
     * Task constructor.
     *
     * @param string $name
     * @param TaskRules $rules a set of rules that apply to this task, inherited from TaskRules
     */
    public function __construct($name, $rules = null)
    {
        $this->name = $name;
        if ($rules) {
            $this->rules = $rules;
        }else {
            $this->rules = new TaskRules();
        }
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function rules()
    {
        return $this->rules;
    }

    function __toString()
    {
        return $this->name;
    }


}