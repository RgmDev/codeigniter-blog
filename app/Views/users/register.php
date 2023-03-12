<?= session()->getFlashdata('error') ?>
<?php
  $className = '';
  $classSurname = '';
  $classEmail = '';
  $classUsername = '';
  $classPassword = '';
  if ($_POST) {
    $className = strlen(validation_show_error('name')) > 0 ? 'is-invalid' : 'is-valid';
    $classSurname = strlen(validation_show_error('surname')) > 0 ? 'is-invalid' : 'is-valid';
    $classEmail = strlen(validation_show_error('email')) > 0 ? 'is-invalid' : 'is-valid';
    $classUsername = strlen(validation_show_error('username')) > 0 ? 'is-invalid' : 'is-valid';
    $classPassword = strlen(validation_show_error('password')) > 0 ? 'is-invalid' : 'is-valid';
  }
?>

<main id="form-register" class="form-signin w-100 m-auto mw-300">
  <form action="/users/register" method="post">
  <?= csrf_field() ?>
    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= $className ?>" id="name" name="name" placeholder="Nombre" value="<?= set_value('name') ?>">
      <label for="floatingInput">Nombre</label>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= $classSurname ?>" id="surname" name="surname" placeholder="Apellidos" value="<?= set_value('surname') ?>">
      <label for="floatingInput">Apellidos</label>
    </div>
    <div class="form-floating mb-2">
      <input type="email" class="form-control <?= $classEmail ?>" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= $classUsername ?>" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating mb-2 mt-1">
      <input type="password" class="form-control <?= $classPassword ?>" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>">
      <label for="password">Password</label>
    </div>
    <div>
      <select class="form-select" aria-label="userRole">
        <option value="user" selected>Usuario</option>
        <option value="publisher">Publicador</option>
        <option value="admin">Administrador</option>
      </select>
    </div>
    <button class="w-100 btn btn-primary mt-3" type="submit">Crear cuenta</button>
  </form>
</main>
