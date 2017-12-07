<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-sm-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($file, 'file')->fileInput() ?>

        <?= Html::submitButton('Load', ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Время</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file) { ?>
                    <tr>
                        <td><?= $file['id'] ?></td>
                        <td><a target="_blank" href="<?= Url::to(['file/info', 'id' => $file['id']]); ?>"><?= $file['name'] ?></a></td>
                        <td><?= $file['created_at'] ?></td>
                    </tr>
                <? } ?>
            </tbody>
        </table>

        Количество файлов, которые имеют более 20-ти тегов: <?= $bigFilesCount ?> шт.
    </div>
</div>
