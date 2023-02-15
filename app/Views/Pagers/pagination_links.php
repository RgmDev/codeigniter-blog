<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination">

        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php foreach ($pager->links() as $link): ?>
            <li <?= $link['active'] ? 'class="page-item active"' : 'page-item' ?>>
                <a href="<?= $link['uri'] ?>" class="page-link">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>