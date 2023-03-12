<?= session()->getFlashdata('error') ?>
<?php
$rol = '';
switch ($userData['role']) {
  case 'admin':
    $rol = 'Administrador';
    break;
  case 'user':
    $rol = 'Usuario';
    break;
  case 'publisher':
    $rol = 'Redactor';
    break;
}

?>

<div class="m-auto mw-150 mb-3">
  <img src="<?= $userData['avatar'] ?>" alt="img-profile" class="rounded-circle mb-3 w-100">

</div>
<div class="m-auto mw-600">

  <?php foreach ($errors as $error): ?>
      <li><?= esc($error) ?></li>
  <?php endforeach ?>

  <?= form_open_multipart('users/upload_avatar') ?> 
  <?= csrf_field() ?>
    <div class="input-group mb-3">
      <input type="file" class="form-control" name="userfile" aria-describedby="inputFileAddon" aria-label="Upload">
      <button class="btn btn-outline-secondary" type="submit" id="inputFileAddon">Aceptar</button>
    </div>
  </form>

  <table id="table-profile" class="table table-hover table-bordered text-end ">
    <tbody>
      <tr>
        <th scope="row">Nombre</th>
        <td class="text-start"><?= $userData['name'] ?></td>
      </tr>
      <tr>
        <th scope="row">Apellidos</th>
        <td class="text-start"><?= $userData['surname'] ?></td>
      </tr>
      <tr>
        <th scope="row">Email</th>
        <td class="text-start"><?= $userData['email'] ?></td>
      </tr>
      <tr>
        <th scope="row">Username</th>
        <td class="text-start"><?= $userData['username'] ?></td>
      </tr>
      <tr>
        <th scope="row">Rol</th>
        <td class="text-start"><?= $rol ?></td>
      </tr>
    </tbody>
  </table>
</div>