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

<script>
  tinymce.init({
    selector: '#newPost-content',
    language: 'es',
    plugins: 'image lists link anchor charmap table quickbars code fullscreen preview codesample',
    toolbar: 'blocks | bold italic codesample bullist numlist table | link image charmap | code preview fullscreen',
    menubar: false,
    setup: (editor) => {
      editor.on('init', () => {
        editor.getContainer().style.transition='border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out';
        editor.getContainer().style.borderWidth='1px';
        <?php
          if (in_array($classContent, ['is-invalid', 'is-valid'])) {
            $color = $classContent == 'is-valid' ? '--bs-success' : '--bs-danger';
            echo "editor.getContainer().style.borderColor='var(".$color.")';";
          }
        ?>
      });
      editor.on('focus', () => {
        <?php
        $color ='rgba(0, 123, 255, .25)';
          if ($classContent == 'is-invalid') {
            $color = 'rgba(220, 53, 69, .25)';
          } elseif ($classContent == 'is-valid') {
            $color = 'rgba(25, 135, 84, .25)';
          } 
          echo "editor.getContainer().style.boxShadow='0 0 0 .3rem ".$color."';";
        ?>
      });
      editor.on('blur', () => {
        editor.getContainer().style.boxShadow='';
        <?php
          if ($classContent == '') {
            echo "editor.getContainer().style.borderColor='';";
          }
        ?>
      });
    }  
  });
</script>

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