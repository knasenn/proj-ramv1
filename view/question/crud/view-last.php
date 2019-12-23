<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$last = isset($last) ? $last : null;

// Create urls for navigation
$urlToCreate = url("question/create");
$urlToDelete = url("question/delete");



?><h1>View last questions</h1>


<?php if (!$last) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>


    <?php foreach ($last as $item) : ?>
        <div class="question">
        <td><b>Subject</b><?= $item->subject ?></td>
        <td><b>Question</b> <?= $item->question ?></td>
        </div><br>


    <?php endforeach; ?>

<h1>View tag(s) with most questions</h1>
<P><b>(If multiple there are more than one with the max amount)</p></b>
    <?php foreach ($tag as $item) : ?>
        <div class="question">
        <br>
        <?php echo $item ?>
        <br>
        <br>
        </div>
        <br>

    <?php endforeach; ?>

<h1>Most active user</h1>
<div class="question">
<br>
<b>Acronym: </b><?php echo $user->acronym ?>
<br>
<b>Firstname: </b><?php echo $user->firstname ?>
<br>
<b>Lastname: </b><?php echo $user->lastname ?>
<br>
<br>
</div>
</table>
