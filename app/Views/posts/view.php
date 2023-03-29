

<p><?= $post['content'] ?></p>
<p class="text-muted"><?= $post['date'] ?> @<?= $post['name'] . $post['surname'] ?></p>
<h5 class="mt-4">Comentarios</h5>

<form action="/comments/create" method="post" class="mb-3">

  <div class="mb-3">
    <label for="comment" class="form-label">Deja tu comentario</label>
    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-primary mb-3">Aceptar</button>
  </div>
</form>