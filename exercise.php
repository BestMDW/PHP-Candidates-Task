<?php

require_once 'vendor/autoload.php';
use Jobs\{ Candidates, Candidate, Vacancy };

$candidates = new Candidates($_SERVER['DOCUMENT_ROOT'] . 'candidates.json');

// get candidates that earn over than 40k
$vacancy = new Vacancy([40000]);

$earn_over_40k = [];
foreach ($candidates as $k => $v) {
	if ($v->candidate->salary > $vacancy->salaryRange[0]) {
		$earn_over_40k[] = $v;
	}
}
var_dump($earn_over_40k);


// get candidates that earn between 20 to 30k and know PHP or JS
// get candidates that earn less than 42k and know Ruby and C
// get candidates that know go
// get candidates that know one of these languages (elixir, erlang, f#, haskell, lisp)

?>
