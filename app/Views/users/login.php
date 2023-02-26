<?= session()->getFlashdata('error') ?>

<?php
  $errorClass = $error ? 'is-invalid' : '';
?>

<div class="text-center ">
  <main class="form-signin w-100 m-auto" style="max-width: 300px;">
    <form action="/users/login" method="post">
    <?= csrf_field() ?>
      <div class="form-floating">
        <input type="text" class="form-control <?= $errorClass ?>" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating mt-1">
        <input type="password" class="form-control <?= $errorClass ?>" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>">
        <label for="password">Password</label>
      </div>
      <button class="w-100 btn btn-primary mt-3" type="submit">Aceptar</button>
    </form>
  </main>
</div>
