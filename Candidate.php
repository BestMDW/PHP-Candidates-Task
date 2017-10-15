<?php
namespace Jobs;

class Candidate
{
    private $name; // Name
    private $gender; // Gender
    private $dob; // Date of birth
    private $nat; // Nationality
    private $skills; // Skills
    private $email; // Email
    private $salary; // Salary
    private $registered; // Registered

    /******************************************************************************************************************/

    /**
     * Candidate constructor.
     * @param \stdClass $candidate
     */
	public function __construct(\stdClass $candidate)
    {
        // Initialize {@Candidate} fields.
        $this->name = $candidate->name;
        $this->gender = $candidate->gender;
        $this->dob = $candidate->dob;
        $this->nat = $candidate->nat;
        $this->skills = $candidate->skills;
        $this->email = $candidate->email;
        $this->salary = $candidate->salary;
        $this->registered = $candidate->registered;
	}

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getNat()
    {
        return $this->nat;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /******************************************************************************************************************/

    /**
     * @return mixed
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /******************************************************************************************************************/

    /**
     * Converts Object into JSON.
     * @return string
     */
	public function toJSON() : string
    {
	    return json_encode($this);
    }
}
?>