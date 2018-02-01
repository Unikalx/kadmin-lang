<?php
/**
 * @var $table string
 * @var $columns array
 * @var $images array
 * @var $categories array
 * @var $product_in_cats array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" >
    <form method='POST' class='clearfix' enctype="multipart/form-data">
        <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

            <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> Галереи

            </span>


            <div class="row">
                <?php if($settings['name']['on_off']):?>
    <!-- name -->
                    <div class="col_6">
                        <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "название"?></div>
                        <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style']?>" id="name" value="<?=$columns['name']?>">
                    </div>
                <?php endif;?>
                <?php if($settings['id_category']['on_off']):?>
    <!-- categories -->
                    <div class="col_6">
                        <div class='pre_input'><?=$settings['id_category']['field_title'] ? $settings['id_category']['field_title'] : "Categories";?></div>

                        <select name='<?=$table?>[id_category]' class="input <?=$settings['id_category']['field_style']?>">
                            <option value="0" style="display: none;" selected>Выбрать</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?=$cat['id']?>" <?=($cat['id'] == $columns['id_category'] ? 'selected' : '')?>><?=$cat['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif;?>
            </div>
            <div class="row">
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

        <?php if(isset($_GET['id'])):?>
            <section class='gellery_section'>
                <div class='underlined h2'>Изображения Галереи
                    <a href='#' class='clear button || fr || upload_gallery'>Загрузить<svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></a>
                </div>
                <div class='clearfix || gallery_container'>
                    <?php if ($images): ?>
                        <?php foreach ($images as $image): ?>
                            <div class='gallery_image' data-image-id="<?=$image['id']?>" id='image_<?=$image['id']?>'>
                                <div class='gallery_bg' style="background-image: url(image.php?width=250&height=250&cropratio=1:1&image=/pictures/<?=$table?>/<?=$image['image']?>)"></div>
                                <span class='gallery_delete'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_close'></use></svg></span>
                                <span class='gallery_move'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_move'></use></svg></span>
                                <div class='gallery_descr'>
                                    <textarea name='image[<?=$image['id']?>]' placeholder='Description' class='input'><?=$image['name'] ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text">Эта галерея не содержит изображений</span>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
        <a href="#" class="show_meta || primary button || fl">Мета Теги для Продвижения</a>
        <section class="meta_tags">
            <div class="underlined h2">Мета Теги </div>
            <div class="row">
                <div class="col_6">
                    <?php if($settings['url']['on_off']):?>
                        <div class="row">
                            <div class="pre_input" data-url-start="<?=$columns['url']?>" data-first-entrance="<?=$url['first-entrance']?>"><?=$settings['url']['field_title'] ? $settings['url']['field_title'] : "META URL"?> <div class="input_count"></div></div>
                            <input type="text" name="<?=$table?>[url]" class="ml_meta || input || to_count <?=$settings['url']['field_style'] ? $settings['url']['field_style'] : ""?>" id="url" value="<?=$columns['url']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['title']['on_off']):?>
                        <div class="row">
                            <div class="pre_input"><?=$settings['title']['field_title']?$settings['title']['field_title']:"META ЗАГОЛОВОК "?><div class="input_count"></div></div>
                            <input type="text" name="<?=$table?>[title]" class="ml_meta || input || to_count <?=$settings['title']['field_style'] ? $settings['title']['field_style'] : ""?>" value="<?=$columns['title']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['keywords']['on_off']):?>
                        <div class="row">
                            <div class="pre_input"><?=$settings['keywords']['field_title']?$settings['keywords']['field_title']:"META КЛЮЧЕВЫЕ СЛОВА "?><div class="input_count"></div></div>
                            <input type="text" name="<?=$table?>[keywords]" class="input || to_count <?=$settings['keywords']['field_style'] ? $settings['keywords']['field_style'] : ""?>" value="<?=$columns['keywords']?>">
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
            <a href="/<?=$url['url']?>" target="_blank" class="button || fr || preview_button">просмотр</a>
        <?php else:?>
            <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
        <?php endif;?>

    </form>
</div>


<div class='upload_container || clearfix'>
    <!-- <a href='#' class='clear button || upload_opened || fr'>Accept</a> -->
    <form action="#" class="dropzone">
        <input type="hidden"  name="gallery" value="1">
        <input type="hidden"  name="upload" value="1">
    </form>
</div>

<script src="js/dropzone.js"></script>
<script>
    $(".dropzone").dropzone({
        url:  location.href,
        maxFilesize: 3,
        dictFileTooBig: 'File is too big',
        dictDefaultMessage: "<div class='text'>Click, to upload files <br> or just drag and drop them here</div><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg>",
        success: function (file, response) {

            res = JSON.parse(response);

            if (res.status == 'error') {
                showErrorMessage(res.message);
            } else {
                var image = JSON.parse(response);

                var html = "<div class='gallery_image' data-image-id='" + image.id + "' id='image_" + image.id + "'>";
                html += "<div class='gallery_bg' style='background-image: url(image.php?width=250&height=250&cropratio=1:1&image=" + image.image + ")'></div>";
                html += "<span class='gallery_delete'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_close'></use></svg></span>";
                html += "<span class='gallery_move'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_move'></use></svg></span>";
                html += "<div class='gallery_descr'>";
                html += "<textarea name='image[" + image.id + "]' placeholder='Description' class='input'>" + image.name + "</textarea>";
                html += "</div>";
                html += "</div>";

                $('.gallery_container span.text').hide();
                $('.gallery_container').append(html);
            }
        }
    });
</script>

<!-- Sort stuff -->
<form action="#" id="sformgallery" method="post" data-gallery-sort-pos>
    <input name="sortdatagallery" id="sortdatagallery" type="hidden" value=""/>
</form>

