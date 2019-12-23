<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("question/create");
$urlToDelete = url("question/delete");



?><h1>View all tags</h1>
<div class="question">
<a href="<?= url("question/spectag/facebook"); ?>">Facebook</a><br>
<a href="<?= url("question/spectag/youtube"); ?>">youtube</a><br>
<a href="<?= url("question/spectag/twitter"); ?>">Twitter</a></div><br>
