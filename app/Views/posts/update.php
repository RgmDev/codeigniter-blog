<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/posts/update/<?= esc($post['id']) ?>" method="post" class="mb-3">
    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="newPost-title" class="form-label">Título</label>
      <input type="input" name="title" class="form-control" id="newPost-title" value="<?= esc($post['title']) ?>">
    </div>
    <div class="mb-3">
      <label for="newPost-content" class="form-label">Contenido</label>
      <textarea name="content" class="form-control" id="newPost-content" rows="4"><?= esc($post['content']) ?></textarea>
    </div>

    <input class="btn btn-primary" type="submit" name="submit" value="Aceptar">
</form>