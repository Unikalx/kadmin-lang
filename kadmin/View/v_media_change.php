<?php
/**
 * @var $table string
 * @var $url array
 * @var $columns array
 * @var $categories array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" data-up-level-id="<?=$columns['id_sect']?>">
        <form data-edit-create="<?=$table?>" action="" method="POST" class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">
<!--            <input type="hidden" name="products[id_category]" value="13">-->
<!--            <input type="hidden" value="products" name="table">-->
<!---->
    <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> медиа

            </span>


                <div class="row">
                    <?php if($settings['name']['on_off']):?>
        <!-- name -->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "Название"?></div>
                            <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style'] ? $settings['name']['field_style'] : ""?>" id="name" value="<?=$columns['name']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['date']['on_off']):?>
                        <div class="col_6">
        <!--date-->
                            <div class='pre_input'><?=$settings['date']['field_title'] ? $settings['date']['field_title'] : "Дата"?></div>
                            <input type='text' name='<?=$table ?>[date]' class='input || datepicker <?=$settings['date']['field_style']?>' value="<?=$columns['date']?>">
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['type']['on_off']):?>
                        <div class="col_6 <?=$settings['date']['field_style']?>" style="margin-top: 3rem;">
        <!-- type -->
                            <input name='<?=$table?>[type]' <?=($columns['type'] == 0)?'checked':''?> type='radio' id='<?=$table?>_type_1' value="0">
                            <label for='<?=$table?>_type_1'>Журнал</label>
                            <input name='<?=$table?>[type]' <?=($columns['type'] == 1)?'checked':''?> type='radio' id='<?=$table?>_type_2' value="1">
                            <label for='<?=$table?>_type_2'>Видео</label>
                        </div>
                    <?php endif;?>

                    <?php if($settings['thumbnail']['on_off']):?>
        <!-- thumbnail -->
                        <div class="col_6 upload_file">
                            <!--file-->
                            <div data-table="<?=$table?>" data-field="thumbnail" data-<?=$table . '_thumbnail'?> class='pre_input' data-image-url="../pictures/<?=$table?>/<?=$columns['thumbnail']?>"><?=$settings['thumbnail']['field_title'] ? $settings['thumbnail']['field_title'] : "thumbnail"?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?=$table?>" data-field="thumbnail" type="file" name='thumbnail' id='<?=$table . '_thumbnail'?>' class="upload <?=$settings['thumbnail']['field_style'] ? $settings['thumbnail']['field_style'] : ""?>" data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?=$table . '_thumbnail'?>"><span class='file_name'><?=$columns['thumbnail']?></span><span class='file_deleted'>Удалить</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Выберите файл</strong></label>
                            <?php if ($columns['thumbnail']): ?>
                                <script>$('[data-<?=$table . '_thumbnail'?>] .delete_thumbnail, [data-<?=$table . '_thumbnail'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>

                        </div>
                    <?php endif;?>
                </div>
                <?php if($settings['video']['on_off']):?>
                    <div class="row">
        <!-- video -->
                            <div class="col_6 ml_video <?=$settings['date']['field_style']?>"  <?=($columns['type'] == 0) ? "style='display:none;'":""?>>
                                <div class='pre_input'><?=$settings['date']['field_title'] ? $settings['date']['field_title'] : "video";?></div>
                                <input type='text' name='<?=$table ?>[video]' class='input' value="<?=$columns['video']?>">
                            </div>

                    </div>
                <?php endif;?>
                <?php if($settings['value']['on_off']):?>
        <!-- value -->
                    <div class="row">
                        <!--ckeditor-->
                        <div class='clearfix'></div>
                        <div class='pre_input'><?=$settings['value']['field_title'] ? $settings['value']['field_title'] : "value"?></div>
						<textarea <?=($settings['value']['field_style'] != 'ckeditor' ? "class='".$settings['value']['field_style']."'" : "data-ckeditor id='".$table."_value'")?> name="<?=$table?>[value]"><?=$columns['value']?></textarea>
                    </div>
                <?php endif;?>
        </section>

        <button class="button || fr || save_button">Сохранить</button>
            <?php if(!isset($_GET['id'])):?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>

        </form>
    </div>
</div>