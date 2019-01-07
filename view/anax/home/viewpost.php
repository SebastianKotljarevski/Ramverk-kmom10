<?php

namespace Anax\View;

?>

<?php if (!$item) : ?>
    <p>There are no items to show.</p>
    <?php
    return;
endif;
?>

<h1><?= $item->rubrik ?></h1>
<p><?= $item->text ?></p>
<?= $user[$item->userId - 1]->acronym ?>

<?= $content ?>

<?php foreach ($answer as $value): ?>
    <?php $grav_url="https://www.gravatar.com/avatar/" . md5(strtolower(trim($user[$value->userId-1]->email))) . "&s=10";?>
    <img src="<?php echo $grav_url; ?>" alt="" />
    <?= $value->text . " - " .  $user[$value->userId - 1]->acronym ?>
    <a class="accordion" style="font-size: 10px;">Svara</a  >
    <div class="panel" style="padding: 0 18px;background-color: white;display: none;overflow: hidden;">
      <?= $value->answerId ?>
    </div>

    <br>
<?php endforeach; ?>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");

    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
