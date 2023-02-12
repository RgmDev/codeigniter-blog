<a href="/posts/create" class="btn btn-outline-primary mb-3">Nuevo artículo</a>

<?php if (! empty($posts) && is_array($posts)): ?>

  <?php foreach ($posts as $post): ?>

    <div class="card mb-3">
      <div class="card-header text-muted d-flex justify-content-between">
        <small>2 days ago</small>
        <div class="d-flex">
          <div class="ms-1">
            <a href="/posts/update/<?= esc($post['id'], 'url') ?>" class="text-primary">
              <i class="bi bi-pencil-square"></i>
            </a>  
          </div>
          <div class="ms-1">        
            <a href="/posts/delete/<?= esc($post['id'], 'url') ?>" class="text-danger">
              <i class="bi bi-x-circle-fill"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <h5 class="card-title"><?= esc($post['title']) ?></h5>
        <h6 class="card-subtitle mb-2 text-muted">@Autor</h6>
        <p class="card-text"><?= $post['content'] ?></p>
        <a class="btn btn-primary btn-sm" href="/posts/<?= esc($post['slug'], 'url') ?>">Ver más</a>
      </div>
      
    </div>

  <?php endforeach ?>

<?php else: ?>

  <h3>No Posts</h3>

  <p>Unable to find any posts for you.</p>

<?php endif ?>