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
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> категорию галерей

            </span>

                <div class="row">
                    <?php if($settings['name']['on_off']):?>
        <!-- name -->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "Имя"?></div>
                            <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style']?>" id="name" value="<?=$columns['name']?>">
                        </div>
                    <?php endif;?>
                    <div class="col_6">
                    <?php if($settings['parent_id']['on_off']):?>
        <!-- parent_id -->
                        <div class='pre_input'><?=$settings['parent_id']['field_title'] ? $settings['parent_id']['field_title'] : "Родительская категория";?></div>
                        <select name='<?=$table ?>[parent_id]' class="input  <?=$settings['name']['field_style']?>">
                            <option value="0" style="display: none;" selected>Выбрать</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?=$category['id']?>" <?=($category['id'] == $columns['parent_id'])?'selected':''?>><?=$category['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['has_child']['on_off']):?>
                        <div class="col_6">
        <!-- has_child -->
                            <div class='pre_input'><?=$settings['has_child']['field_title'] ? $settings['has_child']['field_title'] : "Has children"?></div>
                            <select name='<?=$table ?>[has_child]' class="input <?=$settings['has_child']['field_style']?>">
                                <option value="0" <?=($columns['has_child']==0)?'selected':'';?>>Нет</option>
                                <option value="1" <?=($columns['has_child']==1)?'selected':'';?>>Да</option>
                            </select>
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
                <div class="row">
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
                    <?php if($settings['background']['on_off']):?>
                        <div class="col_6 upload_file">
        <!-- background -->
                            <!--file-->
                            <div data-table="<?=$table?>" data-field="background" data-<?=$table . '_background'?> class='pre_input' data-image-url="/pictures/<?=$table?>/<?=$columns['background']?>"><?=$settings['background']['field_title'] ? $settings['background']['field_title'] : "background"?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?=$table?>" data-field="background" type="file" name='background' id='<?=$table . '_background'?>' class="upload <?=$settings['background']['field_style'] ? $settings['background']['field_style'] : ""?>" data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?=$table . '_background'?>"><span class='file_name'><?=$columns['background']?></span><span class='file_deleted'>Удалить</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Выберите файл&hellip;</strong></label>
                            <?php if ($columns['background']): ?>
                                <script>$('[data-<?=$table . '_background'?>] .delete_thumbnail, [data-<?=$table . '_background'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>
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
                <?php if($settings['value1']['on_off']):?>
        <!-- value1 -->
                    <div class="row <?=$settings['value1']['on_off']?"":"none"?>">
                        <!--ckeditor-->
                        <div class='clearfix'></div>
                        <div class='pre_input'><?=$settings['value1']['field_title'] ? $settings['value1']['field_title'] : "value1"?></div>
                    <textarea <?=($settings['value1']['field_style'] != 'ckeditor' ? "class='".$settings['value1']['field_style']."'" : "data-ckeditor id='".$table."_value1'")?> name="<?=$table?>[value1]"><?=$columns['value1']?></textarea>
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
                    <?php if($settings['field_2']['on_off']):?>
                        <div class="col_6">
        <!-- field_2 -->
                            <div class='pre_input'><?=$settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2"?></div>
                            <input type='text' name='<?=$table ?>[field_2]' class='input <?=$settings['field_2']['field_style'] ? $settings['field_2']['field_style'] : ""?>' value="<?=$columns['field_2']?>">
                        </div>
                    <?php endif;?>
                </div>
        </section>


            <a href="#" class="show_meta || primary button || fl">Мета Теги для Продвижения</a>
            <section class="meta_tags">
                <div class="underlined h2">Мета Теги </div>
                <div class="row">
                    <div class="col_6">

                        <div class="row">
                            <div class="pre_input" data-url-start="<?=$columns['url']?>" data-first-entrance="<?=$url['first-entrance']?>">META URL <div class="input_count"></div></div>
                            <input type="text" name="<?=$table?>[url]" class="ml_meta || input || to_count" id="url" value="<?=$columns['url']?>">
                        </div>

                        <div class="row">
                            <div class="pre_input">МЕТА ЗАГОЛОВОК <div class="input_count"></div></div>
                            <input type="text" name="<?=$table?>[title]" class="ml_meta || input || to_count" value="<?=$columns['title']?>">
                        </div>

                        <div class="row">
                            <div class="pre_input">МЕТА КЛЮЧЕВЫЕ СЛОВА <div class="input_count"></div></div>
                            <input type="text" name="<?=$table?>[keywords]" class="input || to_count" value="<?=$columns['keywords']?>">
                        </div>

                        <div class="row">
                            <div class="pre_input">МЕТА ОПИСАНИЕ <div class="input_count"></div></div>
                            <textarea name="<?=$table?>[description]" class="ml_meta || input || to_count"><?=$columns['description']?></textarea>
                        </div>

                    </div>
                    <div class="col_6" style="margin-top: 3rem;">
                        <p class="google_title"><a href="/<?=$url['url']?>"><span class="ml_title" data-input-name="<?=$table?>[title]"><?=$columns['title']?></span> | <?=SITE_NAME ? SITE_NAME : 'САЙТ';?></a></p>
                        <p class="google_url"><?=$_SERVER['HTTP_HOST']?>/<span data-input-name="<?=$table?>[url]"><?=$url['url']?></span></p>
                        <p class="google_description"  data-input-name="<?=$table?>[description]">
                            <?=$columns['description']?>
                        </p>
                    </div>
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