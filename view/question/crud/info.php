<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$tagInfo = isset($tagInfo) ? $tagInfo : null;

// Create urls for navigation
$urlToCreate = url("question/create");
$urlToDelete = url("question/delete");



?><h1>View all tag questions</h1>



<?php if (!$tagInfo) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>



    <?php foreach ($tagInfo as $item) : ?>
        <div class="question">
        <td><b>Subject: </b><?= $item->subject ?></td><br>
        <td><b>Question: </b><?= $item->question ?></td></div><br>

    <?php endforeach; ?>




</table>
