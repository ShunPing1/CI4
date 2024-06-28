<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<?php
/*
<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pagination">
		<?php if ($pager->hasPrevious()) : ?>
			<li>
				<a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
					<span aria-hidden="true"><?= lang('Pager.first') ?></span>
				</a>
			</li>
			<li>
				<a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
					<span aria-hidden="true"><?= lang('Pager.previous') ?></span>
				</a>
			</li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : ?>
			<li <?= $link['active'] ? 'class="active"' : '' ?>>
				<a href="<?= $link['uri'] ?>">
					<?= $link['title'] ?>
				</a>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
			<li>
				<a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
					<span aria-hidden="true"><?= lang('Pager.next') ?></span>
				</a>
			</li>
			<li>
				<a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
					<span aria-hidden="true"><?= lang('Pager.last') ?></span>
				</a>
			</li>
		<?php endif ?>
	</ul>
</nav>*/
?>

<div class="pagenate">
	<?php if ($pager->hasPrevious()) : ?>
		<a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
			<span aria-hidden="true">第一頁</span>
		</a>
		<a href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
			<span aria-hidden="true">上一頁</span>
		</a>
	<?php endif ?>
	
	<?php if (count($pager->links()) > 1) : ?>
		<?php foreach ($pager->links() as $link) : ?>
			<a href="<?= $link['uri'] ?>"  <?= $link['active'] ? 'class="active"' : '' ?>>
				<?= $link['title'] ?>
			</a>
		<?php endforeach ?>
	<?php endif ?>
	
	<?php if ($pager->hasNext()) : ?>
		<a href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
			<span aria-hidden="true">下一頁</span>
		</a>

		<a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
			<span aria-hidden="true">最後頁</span>
		</a>
	<?php endif ?>
</div>
