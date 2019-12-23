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



?><h1>View all items</h1>

<p>
    <b><a class="createButton" href="<?= $urlToCreate ?>">+ Create NEW question</a></b>
    <br>
    <br>
    <!-- |<a href="<?= $urlToDelete ?>">Delete question</a>  -->
</p>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>


    <?php foreach ($items as $item) : ?>
        <div class="question">
        <td><b>Subject</b><?= $item->subject ?></td>
        <td><b>Question</b> <?= $item->question ?></td>
        <a href="<?= url("question/update/{$item->id}"); ?>">+ Answer question</a></div><br>


    <?php endforeach; ?>
</table>
