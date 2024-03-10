<?php require 'Session.class.php' ?>
<?php Session::start(); ?>
<?php if (isset($_GET['action'])) {
  if ($_GET['action'] == "logout") {
    Session::logout();
  }
}

if (!Session::get("username")) {
  $name =  "Matthieu";
  Session::set("username", $name);
  $tries =  0;
  Session::set("usertries", $tries);
}

?>
<?php
$games = [
  "first" => "fixed", "second" => "random", "third" => "drunk"
];
?>
<?php if (isset($_GET['games'])) {
  var_dump($_GET['games']);
} ?>
<?php require 'header.php' ?>
<?php require 'jeu.php' ?>
<?php $jeu = new Jeu();
$jeu->deviner(isset($_GET['chiffre']) ? $_GET['chiffre'] : NULL);
?>
<div class="alert alert-info">
  <?= 'nb essais:' . Session::get("usertries") ?></div>

<?php if ($jeu->getMessage() == 1) : ?>
  <div class="alert alert-danger">
    <?= "trop grand" ?></div>

<?php elseif ($jeu->getMessage() == 2) : ?>
  <div class="alert alert-danger">
    <?= "trop petit" ?></div>
<?php elseif ($jeu->getMessage() == 0) : ?>
  <div class="alert alert-success">
    <?= "Bravo" ?>
  </div>
<?php endif ?>


<main role="main" class="container">
  <form class="form-inline my-2 my-lg-4" action="index.php" method="GET">
    <?php foreach ($games as $game => $type) : ?>
      <div class="form-check">
        <label>
          <input type="checkbox" class="form-check-input" name="games[]" value="<?= $game ?>">
          <?= $type ?>
        </label>
      </div>

    <?php endforeach; ?>
    <input class="form-control mr-sm-2" type="number" placeholder="entre 1 et 100" name="chiffre" value="<?= $jeu->getValue() ?>">

    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Devinez</button>
  </form>
</main>
<?php require 'footer.php' ?>