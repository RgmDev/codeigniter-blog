

<p><?= $post['content'] ?></p>
<p class="text-muted"><?= esc($post['date']) ?> @<?= esc($post['name'] . $post['surname']) ?></p>

<h5 class="mt-4">Comentarios</h5>
<?php if (isset($userData['role'])) :?>
  <form action="/comments/create" method="post" class="mb-3">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label for="comment" class="form-label">Deja tu comentario</label>
      <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <input type="hidden" name="postId" id="postId" value="<?= esc($post['id']) ?>">
      <input type="hidden" name="slug" id="slug" value="<?= esc($post['slug']) ?>">
      <button type="submit" class="btn btn-primary mb-3">Aceptar</button>
    </div>
  </form>
<?php endif ?>
<?php if (! empty($comments) && is_array($comments) && count($comments) > 0): ?>
  <div class="row">
    <?php foreach ($comments as $comment) : ?>
      <div class="card mb-3 p-0">
        <div class="card-body">
          <div class="d-flex flex-row">
            <div class="pe-2">
              <img class="img-nav rounded-circle" src="<?= isset($comment['avatar']) ? "/uploads/" . $comment['avatar'] : "https://eu.ui-avatars.com/api/?size=300&name=".$comment['name']."+".$comment['surname']; ?>" alt="avatar">
            </div>
            <div>
              <span class=""><strong><?= esc($comment['name'] . ' ' . $comment['surname']) ?></strong></span>
              <span class="text-muted"><small><?= esc($comment['date']) ?></small></span>
              <span class="d-block"><?= esc($comment['text']) ?></span>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>

<?php else: ?>
  <p>No hay comentarios</p>
<?php endif ?>
