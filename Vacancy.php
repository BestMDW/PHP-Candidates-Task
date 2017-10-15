<?php
namespace Jobs;

class Vacancy
{
	private $name;
	private $conditions = [];

    /******************************************************************************************************************/

    /**
     * Vacancy constructor.
     * @param string $name
     * @param null $conditions
     */
	public function __construct(string $name, $conditions = null)
    {
		$this->name = $name;
		if (is_array($conditions)) {
            $this->conditions = $conditions;
        } else {
		    $this->conditions[] = $conditions;
        }
	}

	/******************************************************************************************************************/

    /**
     * Adds new condition for the vacancy.
     * @param \Jobs\VacancyCondition $condition
     * @return bool
     */
	public function addCondition(VacancyCondition $condition) : bool
    {
        $this->conditions[] = $condition;

        return true;
    }

    /******************************************************************************************************************/

    /**
     * Checks if the candidate match all of the conditions for the vacancy.
     * @param \Jobs\Candidate $candidate
     * @return bool
     */
    public function checkCandidate(Candidate $candidate) : bool
    {
        foreach ($this->conditions as $condition)
        {
            if (!$this->checkCondition($candidate, $condition))
            {
                // Condition not match.
                return false;
            }
        }

        // Candidate meets all conditions.
        return true;
    }

    /******************************************************************************************************************/

    /**
     * Checks if the candidate match for the condition.
     *
     * @param \Jobs\Candidate $candidate
     * @param \Jobs\VacancyCondition $condition
     * @return bool
     */
    private function checkCondition(Candidate $candidate, VacancyCondition $condition) : bool
    {
        // Generate method name.
        $conditionCallMethod = $this->getMethodName($condition->getField());

        // Call getter or nested parameter.
        $methods = explode('->', $conditionCallMethod);
        if (count($methods) > 1)
        {
            $value = $candidate->{$methods[0]}()->{$methods[1]};
        }
        else
        {
            $value = $candidate->{$methods[0]}();
        }

        // If $value is an array, loop through and check if contains condition.
        if (is_array($value))
        {
            foreach ($value as $v)
            {
                if ($this->checkConditionValue($v, $condition))
                {
                    // Condition found, return true.
                    return true;
                }
            }

            // Condition IS NOT in the array, return false.
            return false;
        }
        // $value is not an array, check as normal.
        else
        {
            return $this->checkConditionValue($value, $condition);
        }
    }

    /******************************************************************************************************************/

    /**
     * Checks if the $value match the VacancyCondition.
     *
     * @param string $value
     * @param \Jobs\VacancyCondition $condition
     * @return bool
     */
    private function checkConditionValue(string $value, VacancyCondition $condition) : bool
    {
        // If condition's value is an array, only check if the $value is in an array.
        if (is_array($condition->getValue()))
        {
            return in_array($value, $condition->getValue());
        }

        // Otherwise check condition.
        switch ($condition->getCondition())
        {
            case '==':
                return $value == $condition->getValue();

            case '>':
                return $value > $condition->getValue();

            case '>=':
                return $value >= $condition->getValue();

            case '<':
                return $value < $condition->getValue();

            case '<=':
                return $value <= $condition->getValue();

            case '!=':
                return $value != $condition->getValue();

            default:
                return false;
        }
    }

    /******************************************************************************************************************/

    /**
     * Converts string for properly method names.
     * @param string $field
     * @return string
     */
    private function getMethodName(string $field) : string
    {
        $methods = explode('->', $field);
        // Modify first argument for standard getter call name.
        $methods[0] = 'get' . ucfirst($methods[0]);

        return implode('->', $methods);
    }

    /******************************************************************************************************************/

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
}
?>