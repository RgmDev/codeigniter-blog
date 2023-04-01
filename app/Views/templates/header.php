<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Codeigniter</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
  <!-- Tiny -->
  <script src="/assets/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/posts">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/calendar">Calendario</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/users/register">Registro</a>
            </li>
          <?php if (! empty($userData['id']) ): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-nav rounded-circle" src="<?= $userData['avatar'] ?>" alt="avatar">
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/users/profile">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/users/logout">Cerrar sesión</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/users/login">Iniciar sesión</a>
            </li>
          <?php endif ?>
          <!--

          -->
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">

    <h1 class="pt-4"><?= esc($title) ?></h1>
