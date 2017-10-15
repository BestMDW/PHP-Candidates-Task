<?php
/**
 * Created by PhpStorm.
 * User: bestmdw
 * Date: 15/10/17
 * Time: 18:06
 */

namespace Jobs;


class VacancyCondition
{
    private const AVAILABLE_CONDITIONS = [ '==', '>', '>=', '<', '<=', '!=' ];
    private $field;
    private $value;
    private $condition;

    /******************************************************************************************************************/

    /**
     * VacancyCondition constructor.
     * @param string $field
     * @param $value
     * @param string $condition
     * @throws \Exception
     */
    public function __construct(string $field, $value, string $condition)
    {
        // If the given $condition is not permitted throw new exception.
        if (!$this->checkCondition($condition))
        {
            throw new \Exception("Given condition is not permitted.",  2);
        }

        $this->field = $field;
        $this->value = $value;
        $this->condition = $condition;
    }

    /******************************************************************************************************************/

    /**
     * Checks if $condition is permitted.
     * @param string $condition
     * @return bool
     */
    private function checkCondition(string $condition) : bool
    {
        return in_array($condition, $this::AVAILABLE_CONDITIONS);
    }

    /******************************************************************************************************************/

    /**
     * @return string
     */
    public function getField() : string
    {
        return $this->field;
    }

    /******************************************************************************************************************/

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /******************************************************************************************************************/

    /**
     * @return string
     */
    public function getCondition() : string
    {
        return $this->condition;
    }
}