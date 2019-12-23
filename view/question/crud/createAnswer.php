<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewItems = url("question");



?>
<h1>Question</h1>
<!-- <?php echo $questInfo->id ?><br> -->
<?php echo "<div class=question> <b>Subject</b> ".$questInfo->subject ?>
<?php echo "<b>Question</b> ".$questInfo->question ?>
<?php echo "<a href='..\commentq/$questInfo->id'>+ Comment</a></div>";?><br><br>
<?php
foreach ($itemz["itemz2"] as $itema) {
    if ($itema->id_question == $questInfo->id && $itema->id_answer == "question") {
        echo "<div class=answer><b>Komment</b> ".$itema->comment."</div>";
        echo "<br>";
    }
}
?>

<!-- <h1>Answers</h1>
<?php foreach ($items as $item) : ?>
    <a href="<?= url("question/comment/{$item->id}"); ?>"><?= $item->id ?>: Kommentera</a>
    <td><?= $item->answer ?></td><br><br>

<?php endforeach; ?><br> -->

<h1>Answers</h1>
<?php
foreach ($itemz["itemz1"] as $itemx) {
    echo "<b><h3>Answer</b></h3><div class=question> ".$itemx->answer;
    echo "<a href='..\comment/{$itemx->id}'>+ Comment</a></div>";
    echo "<br>";

    foreach ($itemz["itemz2"] as $itema) {
        if ($itemx->id_question == $itema->id_question && $itemx->id == $itema->id_answer) {
            echo "<div class=answer><b>Komment</b> ".$itema->comment."</div>";
        }
    }
}

?>


<h1>Create answer</h1>
<div class="answerBox">
<?= $answer ?>
</div>




<p>
    <a href="<?= $urlToViewItems ?>">View all</a>
</p>
