<?php if (isset($userData['role']) && $userData['role'] == 'publisher') :?>
<a href="/posts/create" class="btn btn-outline-primary mb-3">Nuevo artículo</a>
<?php endif ?>

<?php if (! empty($posts) && is_array($posts)): ?>

  <?php if ($pager) :?>
  <?php $pagi_path='/posts'; ?>
  <?php $pager->setPath($pagi_path); ?>
  <?= $pager->links() ?>
  <?php endif ?>
  
  <?php foreach ($posts as $post): ?>
    <div class="card mb-3">
      <div class="card-header text-muted d-flex justify-content-between">
        <small><?= esc($post['date']) ?></small>
        
        <div class="d-flex">

          <?php if (isset($userData['role']) && $userData['role'] == 'publisher') :?>
          <div class="ms-1">
            <a href="/posts/update/<?= esc($post['id'], 'url') ?>" class="text-primary">
              <i class="bi bi-pencil-square"></i>
            </a>  
          </div>
          <?php endif ?>
          <?php if (isset($userData['role']) && $userData['role'] == 'admin') :?>
          <div class="ms-1">        
            <a href="/posts/delete/<?= esc($post['id'], 'url') ?>" class="text-danger">
              <i class="bi bi-x-circle-fill"></i>
            </a>
          </div>
          <?php endif ?>
        </div>
      </div>
      <div class="card-body">
        <h5 class="card-title"><?= esc($post['title']) ?></h5>
        <h6 class="card-subtitle mb-2 text-muted">@<?= esc($post['name'] . ' ' . $post['surname']) ?></h6>
        <p class="card-text"><?= $post['content'] ?></p>
        <a class="btn btn-primary btn-sm" href="/posts/<?= esc($post['slug'], 'url') ?>">Ver más</a>
      </div>
    </div>

  <?php endforeach ?>

<?php else: ?>

  <h3>No Posts</h3>

  <p>Unable to find any posts for you.</p>

<?php endif ?>