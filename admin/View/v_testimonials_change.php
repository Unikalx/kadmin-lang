 <?php
/**
 * @var $table string
 * @var $url array
 * @var $columns array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" data-up-level-id="<?=$columns['id_sect']?>">
        <form data-edit-create="<?=$table?>" action="" method="POST" class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">

    <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> ОТЗЫВА

            </span>


                <div class="row">
                    <?php if($settings['name']['on_off']):?>
        <!-- name -->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "Имя"?></div>
                            <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style'] ? $settings['name']['field_style'] : ""?>" id="name" value="<?=$columns['name']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['date']['on_off']):?>
                        <div class="col_6">
        <!--date-->
                            <div class='pre_input'><?=$settings['date']['field_title'] ? $settings['date']['field_title'] : "date"?></div>
                            <input type='text' name='<?=$table ?>[date]' class='input || datepicker <?=$settings['date']['field_style'] ? $settings['date']['field_style'] : ""?>' value="<?=$columns['date']?>">
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['thumbnail']['on_off']):?>
        <!-- thumbnail -->
                        <div class="col_6 upload_file">
                            <!--file-->
                            <div data-table="<?=$table?>" data-field="thumbnail" data-<?=$table . '_thumbnail'?> class='pre_input' data-image-url="../pictures/<?=$table?>/<?=$columns['thumbnail']?>"><?=$settings['thumbnail']['field_title'] ? $settings['thumbnail']['field_title'] : "thumbnail"?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?=$table?>" data-field="thumbnail" type="file" name='thumbnail' id='<?=$table . '_thumbnail'?>' class="upload <?=$settings['thumbnail']['field_style'] ? $settings['thumbnail']['field_style'] : ""?>" data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?=$table . '_thumbnail'?>"><span class='file_name'><?=$columns['thumbnail']?></span><span class='file_deleted'>Deleted</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Choose a file</strong></label>
                            <?php if ($columns['thumbnail']): ?>
                                <script>$('[data-<?=$table . '_thumbnail'?>] .delete_thumbnail, [data-<?=$table . '_thumbnail'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>

                        </div>
                    <?php endif;?>

                    <?php if($settings['checkbox']['on_off']):?>
                        <div class="col_6" style="padding-top: 3.5rem;">
        <!-- checkbox -->
                            <input name='<?=$table ?>[checkbox]' type='checkbox' class="checkbox <?=$settings['checkbox']['field_style'];?>" value='<?=$columns['checkbox']?>' id='<?=$table ?>[checkbox]' <?=$columns['checkbox']?'checked':''?>>
                            <label for='<?=$table ?>[checkbox]'><?=$settings['checkbox']['field_title'] ? $settings['checkbox']['field_title'] : "checkbox";?></label>
                        </div>
                    <?php endif;?>
                </div>
                <?php if($settings['value']['on_off']):?>
        <!-- value -->
                    <div class="row">
                        <!--ckeditor-->
                        <div class='clearfix'></div>
                        <div class='pre_input'><?=$settings['value']['field_title'] ? $settings['value']['field_title'] : "value"?></div>
						<textarea <?=($settings['value']['field_style'] != 'ckeditor' ? "class='".$settings['value']['field_style']."'" : "data-ckeditor id='".$table."_value'")?> name="<?=$table?>[value]"><?=$columns['value']?></textarea>
                    </div>
                <?php endif;?>

                <div class="row">
                    <?php if($settings['field_1']['on_off']):?>
                        <div class="col_6">
        <!-- field_1 -->
                            <div class='pre_input'><?=$settings['field_1']['field_title'] ? $settings['field_1']['field_title'] : "field_1"?></div>
                            <input type='text' name='<?=$table ?>[field_1]' class='input <?=$settings['field_1']['field_style'] ? $settings['field_1']['field_style'] : ""?>' value="<?=$columns['field_1']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['field_3']['on_off']):?>
                        <div class="col_6">
        <!-- field_3 -->
                            <div class='pre_input'><?=$settings['field_3']['field_title'] ? $settings['field_3']['field_title'] : "field_1"?></div>
                            <input type='text' name='<?=$table ?>[field_3]' class='input <?=$settings['field_3']['field_style'] ? $settings['field_3']['field_style'] : ""?>' value="<?=$columns['field_3']?>">
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['field_2']['on_off']):?>
                        <div class="col_6">
        <!-- field_2 -->
                            <div class='pre_input'><?=$settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2"?></div>
                            <input type='text' name='<?=$table ?>[field_2]' class='input <?=$settings['field_2']['field_style'] ? $settings['field_2']['field_style'] : ""?>' value="<?=$columns['field_2']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['field_4']['on_off']):?>
                        <div class="col_6">
        <!-- field_4 -->
                            <div class='pre_input'><?=$settings['field_4']['field_title'] ? $settings['field_4']['field_title'] : "field_4"?></div>
                            <input type='text' name='<?=$table ?>[field_4]' class='input <?=$settings['field_4']['field_style'] ? $settings['field_4']['field_style'] : ""?>' value="<?=$columns['field_4']?>">
                        </div>
                    <?php endif;?>
                </div>
        </section>

        <button class="button || fr || save_button">Сохранить</button>

            <?php if(!isset($_GET['id']) && $_GET['id']==''):?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>

        </form>
    </div>
</div>