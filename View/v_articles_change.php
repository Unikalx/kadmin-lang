<?php
/**
 * @var $table string
 * @var $columns array
 * @var $url array
 * @var $settings array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" data-up-level-id="">
        <form data-edit-create="<?=$table?>" action="" method="POST" class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">
<!--            <input type="hidden" name="products[id_category]" value="13">-->
<!--            <input type="hidden" value="products" name="table">-->
<!---->
    <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> статьи
                <a  href="/kadmin/?t=article_comments&c=select&page=1&article=<?=$columns['id']?>" class="h3" style="float:right;">Комментарии</a>
            </span>

                <div class="row">
                    <?php if($settings['name']['on_off']):?>
        <!-- name -->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "name"?></div>
                            <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style'] ? $settings['name']['field_style'] : ""?>" id="name" value='<?=$columns['name']?>'>
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
                    <?php if($settings['categories']['on_off']):?>
        <!-- categories -->
                    <div class="col_6">
                        <div class='pre_input'><?=$settings['categories']['field_title'] ? $settings['categories']['field_title'] : "Categories";?></div>
                        <div class="add_tags || clearfix">
                            <select name='cats_in' class="input <?=$settings['categories']['field_style'];?>">
                                <option value="0" style="display: none;" selected>Выбрать</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
                                <?php endforeach; ?>
                            </select>

                            <button data-add-cat class="button">добавить</button>
                        </div>

                        <div data-cat-in class='tag_spans'>
                            <?php if ($article_in_cats):?>
							<?php foreach ($article_in_cats as $cat): ?>
                                <input type="hidden" name="a_cat[]" value="<?= $cat['id_category'] ?>" data-val="<?= $cat['id_category'] ?>">
                                <span data-val="<?= $cat['id_category'] ?>"><?= $categories[$cat['id_category']]['name'] ?> <a data-delete-cat href="#"><svg class='icon'><use xlink:href='/kadmin/View/img/svgdefs.svg#icon_close'></use></svg></a></span>
                            <?php endforeach; ?>
							<? endif ?>
                        </div>
                    </div>
                <?php endif;?>

                <?php if(ARTICLE_TAGS):?>
                <div class="col_6">
                    <div class='pre_input'><?=$settings['tags']['field_title'] ? $settings['tags']['field_title'] : "Tags";?></div>
                    <div class="add_tags || clearfix || autocomplete_container <?=$settings['tags']['field_style'];?>">
                        <input type="text" name="in_tag" class="input ui-autocomplete-input" id="tagautocomplete">
                        <button data-add-tag="" class="button">добавить</button>
                        <div class="autocomplete"></div>
                    </div>

                    <div data-tags-in>
                        <?php if ($tags): ?>
                            <?php foreach ($tags as $tag): ?>
                                <input type="hidden" name="a_tag[]" value="<?= $tag['name'] ?>" data-val="<?= $tag['name'] ?>">
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div data-tags-name class='tag_spans'>
                        <?php if ($tags): ?>
                            <?php foreach ($tags as $tag): ?>
                                <span><?= $tag['name'] ?> <a data-delete-tag href="#"><img class="icon" style="width:8.7px;height:8.7px;" src="View/img/letter-x.png"></a></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="row">
                <?php if($settings['checkbox']['on_off']):?>
                    <div class="col_6" style="padding-top: 3.5rem;">
        <!-- checkbox -->
                        <input name='<?=$table ?>[checkbox]' type='checkbox' class="checkbox <?=$settings['checkbox']['field_style'];?>" value='<?=$columns['checkbox']?>' id='<?=$table ?>[checkbox]' <?=$columns['checkbox']?'checked':''?>>
                        <label for='<?=$table ?>[checkbox]'><?=$settings['checkbox']['field_title'] ? $settings['checkbox']['field_title'] : "checkbox";?></label>
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
                        <?php if($settings['url']['on_off']):?>
                            <div class="row">
                                <div class="pre_input" data-url-start="<?=$columns['url']?>" data-first-entrance="<?=$url['first-entrance']?>"><?=$settings['url']['field_title'] ? $settings['url']['field_title'] : "META URL"?> <div class="input_count"></div></div>
                                <input type="text" name="<?=$table?>[url]" class="ml_meta || input || to_count <?=$settings['url']['field_style'] ? $settings['url']['field_style'] : ""?>" id="url" value='<?=$columns['url']?>'>
                            </div>
                        <?php endif;?>
                        <?php if($settings['title']['on_off']):?>
                            <div class="row">
                                <div class="pre_input"><?=$settings['title']['field_title']?$settings['title']['field_title']:"META ЗАГОЛОВОК "?><div class="input_count"></div></div>
                                <input type="text" name="<?=$table?>[title]" class="ml_meta || input || to_count <?=$settings['title']['field_style'] ? $settings['title']['field_style'] : ""?>" value='<?=$columns['title']?>'>
                            </div>
                        <?php endif;?>
                        <?php if($settings['keywords']['on_off']):?>
                            <div class="row">
                                <div class="pre_input"><?=$settings['keywords']['field_title']?$settings['keywords']['field_title']:"META КЛЮЧЕВЫЕ СЛОВА "?><div class="input_count"></div></div>
                                <input type="text" name="<?=$table?>[keywords]" class="input || to_count <?=$settings['keywords']['field_style'] ? $settings['keywords']['field_style'] : ""?>" value='<?=$columns['keywords']?>'>
                            </div>
                        <?php endif;?>
                        <?php if($settings['description']['on_off']):?>
                            <div class="row">
                                <div class="pre_input "><?=$settings['description']['field_title']?$settings['description']['field_title']:"META ОПИСАНИЕ "?><div class="input_count"></div></div>
                                <textarea name="<?=$table?>[description]" class="ml_meta || input || to_count <?=$settings['description']['field_style'] ? $settings['description']['field_style'] : ""?>"><?=$columns['description']?></textarea>
                            </div>
                        <?php endif;?>

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
<!--                <a href="/--><?//=$url['url']?><!--" target="_blank" class="button || fr || preview_button">просмотр</a>-->
            <?php else:?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>


        </form>
    </div>
</div>