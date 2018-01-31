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
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> СЛАЙДА

            </span>


                <div class="row">
                    <?php if($settings['name']['on_off']):?>
                        <!-- name -->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "Имя слайда"?></div>
                            <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style'] ? $settings['name']['field_style'] : ""?>" id="name" value="<?=$columns['name']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['checkbox']['on_off']):?>
                        <!-- checkbox -->
                        <div class="col_6" style="margin-top: 3rem;">
                            <input class="<?=$settings['checkbox']['field_style']?>" value=1" name='<?=$table ?>[checkbox]' type='checkbox' value='<?=$columns['checkbox']?>' id='<?=$table ?>[checkbox]' <?=$columns['checkbox']?'checked':''?>>
                            <label for='<?=$table ?>[checkbox]'><?=$settings['checkbox']['field_title'] ? $settings['checkbox']['field_title'] : "checkbox"?></label>
                        </div>
                    <?php endif;?>
                </div>

                <?php if($settings['value']['on_off']):?>
                    <!-- value -->
                    <div class="row">
                        <!--ckeditor-->
                        <div class='clearfix'></div>
                        <div class='pre_input'><?=$settings['value']['field_title'] ? $settings['value']['field_title'] : "Основной контент"?></div>
                        <textarea <?=($settings['value']['field_style'] != 'ckeditor' ? "class='".$settings['value']['field_style']."'" : "data-ckeditor id='".$table."_value'")?> name="<?=$table?>[value]"><?=$columns['value']?></textarea>
                    </div>
                <?php endif;?>
                <div class="row">
                    <?php if($settings['field_1']['on_off']):?>
                        <div class="col_6">
                            <!-- field_1 -->
                            <div class='pre_input'><?=$settings['field_1']['field_title'] ? $settings['field_1']['field_title'] : "field_1"?></div>
                            <input type='text' name='<?=$table ?>[field_1]' class='input <?=$settings['field_1']['field_style']?>' value="<?=$columns['field_1']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['field_3']['on_off']):?>
                        <div class="col_6">
                            <!-- field_3 -->
                            <div class='pre_input'><?=$settings['field_3']['field_title'] ? $settings['field_3']['field_title'] : "field_3"?></div>
                            <input type='text' name='<?=$table ?>[field_3]' class='input <?=$settings['field_3']['field_style']?>' value="<?=$columns['field_3']?>">
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['field_2']['on_off']):?>
                        <div class="col_6">
                            <!-- field_2 -->
                            <div class='pre_input'><?=$settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2"?></div>
                            <input type='text' name='<?=$table ?>[field_2]' class='input <?=$settings['field_2']['field_style']?>' value="<?=$columns['field_2']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['field_4']['on_off']):?>
                        <div class="col_6">
                            <!-- field_4 -->
                            <div class='pre_input'><?=$settings['field_4']['field_title'] ? $settings['field_4']['field_title'] : "field_4"?></div>
                            <input type='text' name='<?=$table ?>[field_4]' class='input <?=$settings['field_4']['field_style']?>' value="<?=$columns['field_4']?>">
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['image1']['on_off']):?>
                        <!-- image1 -->
                        <div class="col_6 upload_file">
                            <!--file-->
                            <div data-table="<?=$table?>" data-field="image1" data-<?=$table . '_image1'?> class='pre_input' data-image-url="/pictures/<?=$table?>/<?=$columns['image1']?>"><?=$settings['image1']['field_title'] ? $settings['field_4']['field_title'] : "image1";?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?=$table?>" data-field="image1" type="file" name='image1' id='<?=$table . '_image1'?>' class="upload <?=$settings['image1']['field_style']?>" data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?=$table . '_image1'?>"><span class='file_name'><?=$columns['image1']?></span><span class='file_deleted'>Удалить</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Выберите файл</strong></label>
                            <?php if ($columns['image1']): ?>
                                <script>$('[data-<?=$table . '_image1'?>] .delete_thumbnail, [data-<?=$table . '_image1'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>

                        </div>
                    <?php endif;?>
                    <?php if($settings['image2']['on_off']):?>
                        <!-- image2 -->
                        <div class="col_6 upload_file">
                            <!--file-->
                            <div data-table="<?=$table?>" data-field="image2" data-<?=$table . '_image2'?> class='pre_input' data-image-url="/pictures/<?=$table?>/<?=$columns['image2']?>"><?=$settings['image2']['field_title'] ? $settings['field_4']['field_title'] : "image2";?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?=$table?>" data-field="image2" type="file" name='image2' id='<?=$table . '_image2'?>' class="upload <?=$settings['image2']['field_style']?>" data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?=$table . '_image2'?>"><span class='file_name'><?=$columns['image2']?></span><span class='file_deleted'>Удалить</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Выберите файл</strong></label>
                            <?php if ($columns['image2']): ?>
                                <script>$('[data-<?=$table . '_image2'?>] .delete_thumbnail, [data-<?=$table . '_image2'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>
                </div>

            </section>

            <button class="button || fr || save_button">Сохранить</button>

            <?php if(isset($_GET['id']) && $_GET['id']!=''):?>
                <a href="/<?=$url['url']?>" target="_blank" class="button || fr || preview_button">просмотр</a>
            <?php else:?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>


        </form>
    </div>
</div>