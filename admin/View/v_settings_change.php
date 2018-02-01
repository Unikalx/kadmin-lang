<?php
/**
 * @var $table string
 * @var $id string
 * @var $columns array
 */
?>
<div class="row">
    <div class="col_9">
        <section>
            <span class="h1">Таблица "<span class="ml_table_name" data-table="<?=$table;?>" data-table-id="<?=$id?>"><?=(constant(strtoupper($table))==false || constant(strtoupper($table))==1) ? $table : constant(strtoupper($table));?></span>"
                <span class="fr">
                    <input name="on_off_table" type="checkbox" id="on_off_table"  <?=(constant(strtoupper($table))!=false) ? "checked" : "";?>>
                    <label for="on_off_table" style="font-size: 1.7rem;">Таблица ВКЛ/ВЫКЛ</label>
                </span>
            </span>
            <table class="table <?=(constant(strtoupper($table))==false) ? "disabled" : "";?>">
                <thead>
                <tr>
                    <td class="tc" width="65">ID</td>
                    <td class="tc" width="130">Имя</td>
                    <td class="tc" width="130">Название</td>
                    <td class="tc" width="130">Стиль</td>
                    <td class="tc" width="45">ON/OFF</td>
                </tr>
                </thead>
                <tbody class="ml_table">
                <?php $i=0;?>

                <?php foreach ($columns as $col): ?>
                    <tr tableCol="<?= $col['table'] ?>" id="tr_<?= ++$i; ?>" class="<?=($col['on_off'] == 0) ? 'disabled_tr':'';?>">
                        <td class="tc || ml_field_id "><?= $i ?></td>
                        <td class="tc || ml_name" typeCol="<?= $col['field_name'] ?>"><?= (preg_match('/Translate/', $col['table']))?' Translate ':''?> <?= $col['field_name'] ?></td>
                        <td class="tc"><input type="text" class="input || ml_title " value="<?= $col['field_title']?>"></td>
                        <td class="tc || ml_type">
                            <select name='style' class="input || ml_style">
                                <option value="0"        <?=($col['field_style']==0)          ? 'selected':'';?>>Select</option>
                                <option value="ckeditor" <?=($col['field_style']=="ckeditor") ? 'selected' :'';?>>Ckeditor</option>
                                <option value="small"    <?=($col['field_style']=="small")    ? 'selected' :'';?>>Small</option>
                                <option value="medium"   <?=($col['field_style']=="medium")   ? 'selected' :'';?>>Medium</option>
                                <option value="big"      <?=($col['field_style']=="big")      ? 'selected' :'';?>>Big</option>
                            </select>
                        </td>

                        <td class="tc ">
                            <div class="row" >
                                <div class="switch || ml_on_off <?php if($col['on_off'] == 1){echo 'active';}?>" style="margin-top: 3px;margin-bottom: 0;">
                                    <span class="switcher"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <div class="col_3">
        <div class="row">
            <section class="rename_table" >
                <form action="" class="ml_save_table_name">
                    <span class="h1 || block_name">переименовать таблицу</span>
                    <div class="row">
                        <span>Имя таблицы</span>
                        <input id="ml_new_name" type="text" class="input || ml_new_table_name">
                    </div>
                    <div class="row">
                        <button href="#" class="button || fr">Сохранить</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<!--     Content         -->