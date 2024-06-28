<h2><?= esc($title) ?></h2>

<?php if ($news_list !== []): ?>

    <?php foreach ($news_list as $news_item): ?>

        <h3><?= esc($news_item['title']) ?></h3>
        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        

    <?php endforeach; ?>

<?php else: ?>
    <h3><?= print_r($news_list) ?></h3>
    <h3>No News</h3>
    <p>Unable to find any news for you.</p>

<?php endif ?>
