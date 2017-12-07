<?php
?>

<?php if (isset($file)) { ?>
    <div class="row">
        <div class="col-sm-12">
            Файл <strong><?= $file->name ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            Теги:
            <ul class="list-group">
            <?php foreach ($tags as $name => $count) { ?>
                <li class="list-group-item"><?= $name ?> : <?= $count ?> шт.</li>
            <? } ?>
            </ul>
        </div>
    </div>

<? } ?>
