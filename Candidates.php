<?php
namespace Jobs;
use Jobs\Candidate;
use Jobs\Vacancy;

class Candidates implements \IteratorAggregate, \Countable
{
    //
	private $allCandidates = [];

	/******************************************************************************************************************/

	public function __construct(string $filePath)
    {
        // Check if file exists and contains JSON data type.
		if (!file_exists($filePath) or pathinfo($filePath, PATHINFO_EXTENSION) != 'json')
		{
		    // Throw an exception if file does NOT exist or IS NOT JSON file.
			throw new \Exception("Error Loading Candidates file", 1);
		}
		// Read and decode JSON file.
		$candidates = json_decode(file_get_contents($filePath));

		// Loop through all candidates and add them to the list of candidates.
		foreach ($candidates->results as $candidate)
		{
			$this->add(new Candidate($candidate));
		}
	}

	public function get(int $row)
    {
        return $this->allCandidates[$row];
    }

    /******************************************************************************************************************/

    /**
     * @return array Returns all candidates.
     */
    public function getAllCandidates() : array
    {
        return $this->allCandidates;
    }

    /******************************************************************************************************************/

	public function getIterator()
    {
		return new \ArrayIterator($this->allCandidates);
	}

    /******************************************************************************************************************/

    /**
     * Adds new candidate into the list of candidates.
     * @param \Jobs\Candidate $candidate
     */
	public function add(Candidate $candidate)
    {
		$this->allCandidates[] = $candidate;
	}

    /******************************************************************************************************************/

    /**
     * @return int Gets number of the all candidates.
     */
	public function count() : int
    {
		return count($this->allCandidates);
	}
}
?>