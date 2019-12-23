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



?><h1>View all questions</h1>



<?php if (!$questions) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>



    <?php foreach ($questions as $item) : ?>
        <div class="question">
        <td><b>Question: </b><?= $item->question ?></td></div>

    <?php endforeach; ?>


<h1>View all comments</h1>



<?php if (!$comments) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>


<?php foreach ($comments as $item) : ?>
    <div class="question">
    <td><b>Comment: </b><?= $item->comment ?></td></div>

<?php endforeach; ?>



</table>
