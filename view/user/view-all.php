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



?><h1>View all users</h1>



<?php if (!$items) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>


    <?php foreach ($items as $item) : ?>
        <div class="question">
        <td><b>Acronym: </b><?= $item->acronym ?></td>
        <td><b>Firstname:</b> <?= $item->firstname ?></td>
        <td><b>Lastname:</b> <?= $item->lastname ?></td>  |
        <a href="<?= url("user/info/{$item->id}"); ?>">View info</a></div><br>

    <?php endforeach; ?>
</table>
