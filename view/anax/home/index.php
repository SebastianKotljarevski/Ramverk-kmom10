<?php

namespace Anax\View;

?>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>

<?php foreach ($items as $item) : ?>
    <h1><?= $item->rubrik ?></h1>
    <?= $user[$item->userId - 1]->acronym ?>
    <br>
    <a href="<?= url("home/viewpost/{$item->postId}"); ?>">Visa inlägg.</a>
<?php endforeach; ?>
