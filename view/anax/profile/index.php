<?php

namespace Anax\View;

?>

<img src="<?php echo $image; ?>" alt="" />

<p>Akronym: <?= $profile->acronym ?></p>
<p>Email: <?= $profile->email ?></p>
<p>Namn: <?= $profile->firstname . " " . $profile->lastname?></p>
<a href="<?= url("profile/edit/{$profile->id}"); ?>">Redigera profil</a>
