<?= session()->getFlashdata('error') ?>
<?php
  $classTitle = '';
  $classContent = '';
  if ($_POST) {
    $classTitle = strlen(validation_show_error('title')) > 0 ? 'is-invalid' : 'is-valid';
    $classContent = strlen(validation_show_error('content')) > 0 ? 'is-invalid' : 'is-valid';
  }
  $titleValue = $formAction == 'create' ? '' : $post['title'];
  $contentValue = $formAction == 'create' ? '' : $post['content'];
?>

<form action="/posts/<?= $formAction ?>" method="post" class="mb-3">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="newPost-title" class="form-label">Título</label>
      <input type="input" name="title" class="form-control <?= $classTitle ?>" id="newPost-title" value="<?= set_value('title', $titleValue) ?>">
      <div id="newPost-titleFeedback" class="invalid-feedback">
        <?= validation_show_error('title') ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="newPost-content" class="form-label">Contenido</label>
      <textarea name="content" class="form-control <?= $classContent ?>" id="newPost-content" rows="4"><?= set_value('content', $contentValue) ?></textarea>
      <div id="newPost-contentFeedback" class="invalid-feedback">
        <?= validation_show_error('content') ?>
      </div>
    </div>

    <input class="btn btn-primary" type="submit" name="submit" value="Aceptar">
</form>