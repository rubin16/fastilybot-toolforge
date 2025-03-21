<?php
    date_default_timezone_set("UTC");
	
    /**
     * Generates a table row for each database report
     */
    function generateRow($id, $name, $updateFreq)
    {
        echo "<tr>";

        $f = "r/report" . $id . ".txt";

        echo tdWrap($id);
        echo tdWrap(sprintf("<a href=\"%s\">%s</a>", $f, $name));
        echo tdWrap($updateFreq);
		echo tdWrap(file_exists($f) ? date("H:i, d F Y (T)", filectime($f)) : "n/a");
        echo "</tr>";
    }

    /**
     * Wraps a string in td tags.
     */
    function tdWrap($s)
    {
        return sprintf("<td>%s</td>", $s);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="https://tools-static.wmflabs.org/cdnjs/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" crossorigin="anonymous">

	<title>fastilybot @ toolforge (forked for ru.wiki by rubin16)</title>
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="https://github.com/fastily/fastilybot-toollabs">Source</a>
					</li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://toolforge.org">Toolforge</a>
                    </li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron mt-3">
			<h1 class="display-4">fastilybot @ toolforge (forked by rubin16)</h1>
			<p class="lead">[Raw DB Reports for ru.wiki]</p>
		</div>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Report</th>
					<th>Name</th>
					<th>Frequency</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php
					generateRow(1, "Файлы с дубликатами на Викискладе", "Раз в неделю"); 
#					generateRow(2, "enwp files tagged as free and non-free", "Weekly"); 
#					generateRow(3, "free files on enwp with no fileusage", "Weekly");
#					generateRow(4, "free files on enwp with links to the mainspace", "Weekly");
#					generateRow(5, "all non-free files on enwp", "Weekly");
#					generateRow(6, "all free files on enwp", "Weekly");
#					generateRow(7, "oversized non-free images on enwp", "Weekly");
#					generateRow(8, "all files on enwp", "Weekly");
#					generateRow(9, "orphaned free files on enwp", "Weekly");
#					generateRow(10, "orphaned, low-res free files", "Weekly");
#					generateRow(11, "file pages shadowing commons files", "Weekly");
#					generateRow(12, "enwp files without an obvious/machine-readable source", "Weekly");
#					generateRow(13, "files shadowing a Commons file", "Weekly");
#					generateRow(14, "transcluded non-existent templates on enwp", "Weekly");
#					generateRow(15, "non-free pdfs on enwp", "Weekly");
#					generateRow(16, "orphaned file talk pages", "Weekly");
#					generateRow(17, "all spi reports on enwp", "Weekly");
				?>
			</tbody>
		</table>
	</div>

    <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/popper.js/1.16.1/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
