<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}


?><article <?= classList($classes) ?>>
<?= $content ?>
<?= $login ?><br>
<?= $firstname ?><br>
<a href="<?= url("user/logout/"); ?>"><?= $loggaut ?></a>
</article>
