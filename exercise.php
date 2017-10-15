<?php
/**** TASK ****
 * ToDo: get candidates that earn between 20 to 30k and know PHP or JS
 * ToDo: get candidates that earn less than 42k and know Ruby and C
 * ToDo: get candidates that know go
 * ToDo: get candidates that know one of these languages (elixir, erlang, f#, haskell, lisp)
 **** /TASK ****/

require_once 'vendor/autoload.php';
use \Jobs\{ Candidates, Vacancy, VacancyCondition };

// Load candidates.
try {
    $candidates = new Candidates('candidates.json');
} catch (Exception $e) {
    echo $e->getMessage();
}

/**** JOB #1 SPECIFICATION ****/
$vacancy1 = new Vacancy('Job 1', [
    new VacancyCondition('skills->languages', ['php', 'js'], '=='),
    new VacancyCondition('salary', '20000', '>='),
    new VacancyCondition('salary', '30000', '<='),
]);
$candidatesForVacancy1 = [];

/**** JOB #2 SPECIFICATION ****/
$vacancy2 = new Vacancy('Job 2', [
    new VacancyCondition('salary', '42000', '<'),
    new VacancyCondition('skills->languages', 'ruby', '=='),
    new VacancyCondition('skills->languages', 'c', '=='),
]);
$candidatesForVacancy2 = [];

/**** JOB #3 SPECIFICATION ****/
$vacancy3 = new Vacancy('Job 3', [
    new VacancyCondition('skills->languages', 'go', '=='),
]);
$candidatesForVacancy3 = [];

/**** JOB #4 SPECIFICATION ****/
$vacancy4 = new Vacancy('Job 4', [
    new VacancyCondition('skills->languages', ['elixir', 'erlang', 'f#', 'haskell', 'lisp'], '=='),
]);
$candidatesForVacancy4 = [];

// Loop through all candidates and select the best candidates for the specific roles.
foreach ($candidates->getAllCandidates() as $candidate)
{
    if ($vacancy1->checkCandidate($candidate)) { $candidatesForVacancy1[] = $candidate; }
    if ($vacancy2->checkCandidate($candidate)) { $candidatesForVacancy2[] = $candidate; }
    if ($vacancy3->checkCandidate($candidate)) { $candidatesForVacancy3[] = $candidate; }
    if ($vacancy4->checkCandidate($candidate)) { $candidatesForVacancy4[] = $candidate; }
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<title>Candidates Exercise</title>
</head>
<body>
	<!-- HEADER -->
	<header id="main-header">
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
			<div class="container">
				<a href="#" class="navbar-brand">Candidates</a>
			</div>
		</nav>
	</header>

	<!-- CONTENT -->
	<div id="content">
		<div class="container">
			<div class="row my-2">
				<div class="col-md-6">
					<!-- JOB #1 -->
					<div class="card text-white bg-info mb-3">
						<div class="card-body">
							<h3 class="card-title">
								PHP or JS
							</h3>
							<div class="card-subtitle mb-2 text-white">Earnings between 20k and 30k.</div>
							<ul class="list-group list-group-flush text-dark">
<?php
								foreach ($candidatesForVacancy1 as $candidate)
								{
									echo '
										<li class="list-group-item">
											<h4 class="display-6">' . ucfirst($candidate->getName()->title) . ' ' . ucfirst($candidate->getName()->first) . ' ' . ucfirst($candidate->getName()->last) . '</h4>
											<p class="card-text my-1"><b>Gender:</b> ' . $candidate->getGender() . '</p>
											<p class="card-text my-1"><b>DOB:</b> ' . $candidate->getDob() . '</p>
											<p class="card-text my-1"><b>Nationality:</b> ' . $candidate->getNat() . '</p>
											<p class="card-text my-1"><b>Skills:</b> ' . implode(', ', $candidate->getSkills()->languages) . '</p>
											<p class="card-text my-1"><b>E-mail:</b> <a href="mailto:' . $candidate->getEmail() . '">' . $candidate->getEmail() . '</a></p>
											<p class="card-text my-1"><b>Salary:</b> &pound;' . $candidate->getSalary() . '</p>
											<p class="card-text my-1"><b>Registered:</b> ' . $candidate->getRegistered() . '</p>
										</li>';
								}
?>
							</ul>
						</div>
					</div>

					<!-- JOB #3 -->
					<div class="card text-white bg-success mb-3">
						<div class="card-body">
							<h3 class="card-title">
								GO
							</h3>
							<div class="card-subtitle mb-2 text-white">Earnings not specified.</div>
							<ul class="list-group list-group-flush text-dark">
                                <?php
                                foreach ($candidatesForVacancy3 as $candidate)
                                {
                                    echo '
										<li class="list-group-item">
											<h4 class="display-6">' . ucfirst($candidate->getName()->title) . ' ' . ucfirst($candidate->getName()->first) . ' ' . ucfirst($candidate->getName()->last) . '</h4>
											<p class="card-text my-1"><b>Gender:</b> ' . $candidate->getGender() . '</p>
											<p class="card-text my-1"><b>DOB:</b> ' . $candidate->getDob() . '</p>
											<p class="card-text my-1"><b>Nationality:</b> ' . $candidate->getNat() . '</p>
											<p class="card-text my-1"><b>Skills:</b> ' . implode(', ', $candidate->getSkills()->languages) . '</p>
											<p class="card-text my-1"><b>E-mail:</b> <a href="mailto:' . $candidate->getEmail() . '">' . $candidate->getEmail() . '</a></p>
											<p class="card-text my-1"><b>Salary:</b> &pound;' . $candidate->getSalary() . '</p>
											<p class="card-text my-1"><b>Registered:</b> ' . $candidate->getRegistered() . '</p>
										</li>';
                                }
                                ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- JOB #2 -->
					<div class="card text-white bg-danger mb-3">
						<div class="card-body">
							<h3 class="card-title">
								Ruby and C
							</h3>
							<div class="card-subtitle mb-2 text-white">Earnings less than 42k.</div>
							<ul class="list-group list-group-flush text-dark">
                                <?php
                                foreach ($candidatesForVacancy2 as $candidate)
                                {
                                    echo '
										<li class="list-group-item">
											<h4 class="display-6">' . ucfirst($candidate->getName()->title) . ' ' . ucfirst($candidate->getName()->first) . ' ' . ucfirst($candidate->getName()->last) . '</h4>
											<p class="card-text my-1"><b>Gender:</b> ' . $candidate->getGender() . '</p>
											<p class="card-text my-1"><b>DOB:</b> ' . $candidate->getDob() . '</p>
											<p class="card-text my-1"><b>Nationality:</b> ' . $candidate->getNat() . '</p>
											<p class="card-text my-1"><b>Skills:</b> ' . implode(', ', $candidate->getSkills()->languages) . '</p>
											<p class="card-text my-1"><b>E-mail:</b> <a href="mailto:' . $candidate->getEmail() . '">' . $candidate->getEmail() . '</a></p>
											<p class="card-text my-1"><b>Salary:</b> &pound;' . $candidate->getSalary() . '</p>
											<p class="card-text my-1"><b>Registered:</b> ' . $candidate->getRegistered() . '</p>
										</li>';
                                }
                                ?>
							</ul>
						</div>
					</div>

					<!-- JOB #4 -->
					<div class="card text-white bg-dark mb-3">
						<div class="card-body">
							<h3 class="card-title">
								Elixir or Erlang or F# or Haskell or Lisp
							</h3>
							<div class="card-subtitle mb-2 text-white">Earnings not specified.</div>
							<ul class="list-group list-group-flush text-dark">
                                <?php
                                foreach ($candidatesForVacancy4 as $candidate)
                                {
                                    echo '
										<li class="list-group-item">
											<h4 class="display-6">' . ucfirst($candidate->getName()->title) . ' ' . ucfirst($candidate->getName()->first) . ' ' . ucfirst($candidate->getName()->last) . '</h4>
											<p class="card-text my-1"><b>Gender:</b> ' . $candidate->getGender() . '</p>
											<p class="card-text my-1"><b>DOB:</b> ' . $candidate->getDob() . '</p>
											<p class="card-text my-1"><b>Nationality:</b> ' . $candidate->getNat() . '</p>
											<p class="card-text my-1"><b>Skills:</b> ' . implode(', ', $candidate->getSkills()->languages) . '</p>
											<p class="card-text my-1"><b>E-mail:</b> <a href="mailto:' . $candidate->getEmail() . '">' . $candidate->getEmail() . '</a></p>
											<p class="card-text my-1"><b>Salary:</b> &pound;' . $candidate->getSalary() . '</p>
											<p class="card-text my-1"><b>Registered:</b> ' . $candidate->getRegistered() . '</p>
										</li>';
                                }
                                ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
