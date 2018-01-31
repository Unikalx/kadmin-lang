<div class='wrapper'>
    <form action='/kadmin/?c=edit&t=<?=$table ?><?=$_GET['up_level_id'] ? '&up_level_id=' . $_GET['up_level_id'] : '' ?><?=$_GET['up_level_table'] ? '&up_level_table=' . $_GET['up_level_table'] : '' ?>'  method='POST' class='clearfix' enctype="multipart/form-data">
        <input type="hidden" value="<?=$table?>" name="table">
        <?php if ($columns['id']['value']): ?>
            <input type="hidden" value="<?=$columns['id']['value']?>" name="<?=$table?>[id]">
        <?php endif; ?>

        <section>
            <span class='h1'>Редактирование галереи</span>
            <?php foreach ($columns as $pr): ?>
                <?php if (!(in_array($pr['field_name'], ['url', 'id', 'position'])) && strpos($pr['field_name'], 'title') === false && strpos($pr['field_name'], 'keywords') === false && strpos($pr['field_name'], 'description') === false): ?>

                    <?php if ($pr['col']): ?>

                        <?php if ($pr['col'] == 1): ?>
                            <div class='row'>
                            <div class="col_6 <?=($pr['field_type'] == 'file'?'upload_file':'')?>">
                        <?php endif; ?>


                        <?php if ($pr['col'] == 2): ?>
                            </div>
                            <div class="col_6 <?=($pr['field_type'] == 'file'?'upload_file':'')?>">
                        <?php endif;?>


                        <?php if ($pr['col'] == -1): ?>
                            <div class="row">
                            <div class="col_6">
                        <?php endif;?>
                    <?php else: ?>
                        <div class='row'>
                    <?php endif; ?>


                    <!--select-->
                    <?php if ($pr['field_type'] == 'select'): ?>
                        <div class='pre_input'><?=$pr['field_title']?></div>
                        <select name='<?=$table ?>[<?=$pr['field_name']?>]' class="input">
                            <?php foreach($pr['select'] as $sel): ?>
                                <option value="<?=$sel['id']?>" <?=($sel['id'] == $pr['selected'])?'selected':''?>><?=$sel['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>

                    <!--checkbox-->
                    <?php if ($pr['field_type'] == 'checkbox'): ?>
                        <input name='<?=$table ?>[<?=$pr['field_name']?>]' type='checkbox' value='<?=$pr['value'] ?>' id='<?=$table ?>[<?=$pr['field_name']?>]' <?=$pr['value']?'checked':''?>>
                        <label for='<?=$table ?>[<?=$pr['field_name']?>]'><?=$pr['field_title']?></label>
                    <?php endif; ?>

                    <!--date-->
                    <?php if ($pr['field_type'] == 'date'): ?>
                        <div class='pre_input'><?=$pr['field_title']?></div>
                        <input type='text' name='<?=$table ?>[<?=$pr['field_name']?>]' class='input || datepicker' value="<?=$pr['value']?>">
                    <?php endif; ?>

                    <!--datetime-->
                    <?php if ($pr['field_type'] == 'datetime'): ?>
                        <div class='pre_input'><?=$pr['field_title']?></div>
                        <input type='text' name='<?=$table ?>[<?=$pr['field_name']?>]' class='input || datepicker' value="<?=$pr['value']?>">
                    <?php endif; ?>

                    <!--varchar-->
                    <?php if ($pr['field_type'] == 'text'):?>
                        <div class='pre_input'><?=$pr['field_title']?></div>
                        <input type='text' name='<?=$table ?>[<?=$pr['field_name']?>]' class='input' value="<?=$pr['value']?>">
                    <?php endif; ?>

                    <!--textarea-->
                    <?php if ($pr['field_type'] == 'textarea'): ?>
                        <div class='pre_input'><?=$pr['field_title']?></div>
                        <textarea name="<?=$table?>[<?=$pr['field_name']?>]" class='input'><?=$pr['value']?></textarea>
                    <?php endif; ?>

                    <!--ckeditor-->
                    <?php if ($pr['field_type'] == 'ckeditor'): ?>
                        <div class='clearfix'></div>
                        <div class='pre_input'><?=$pr['field_title']?></div>
                        <textarea data-ckeditor id='<?=$table?>_<?=$pr['field_name']?>' name="<?=$table?>[<?=$pr['field_name']?>]"><?=$pr['value']?></textarea>
                    <?php endif; ?>

                    <!--file-->
                    <?php if ($pr['field_type'] == 'file'): ?>
                        <div data-table="<?=$table?>" data-field="<?=$pr['field_name']?>" data-<?=$table . '_' . $pr['field_name']?> class='pre_input' data-image-url="/kadmin/picture/<?=$table?>/<?=$pr['value'] ?>"><?=$pr['field_title']?>
                            <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                            <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                        </div>
                        <input data-table="<?=$table?>" data-field="<?=$pr['field_name']?>" type="file" name='<?=$pr['field_name']?>' id='<?=$table . '_' . $pr['field_name']?>' class="upload" data-multiple-caption="{count} files selected">
                        <label class='last_item' for="<?=$table . '_' . $pr['field_name']?>"><span class='file_name'><?=$pr['value']?></span><span class='file_deleted'>Удалить</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Выберите файл&hellip;</strong></label>
                    <?php if ($pr['value']): ?>
                        <script>$('[data-<?=$table . '_' . $pr['field_name']?>] .delete_thumbnail, [data-<?=$table . '_' . $pr['field_name']?>] .watch_thumbnail').addClass('active')</script>
                    <?php endif; ?>
                    <?php endif; ?>


                    <?php if ($pr['col']): ?>
                        <?php if ($pr['col'] == 2): ?>
                            </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($pr['col'] == -1): ?>
                            </div>
                            </div>
                        <?php endif;?>
                    <?php else: ?>
                        </div>
                    <?php endif; ?>


                <?php endif; ?>
            <?php endforeach; ?>
        </section>

        <?php if ($action == 1): ?>
            <section class='gellery_section'>
            <div class='underlined h2'>Изображения галереи
                <a href='#' class='clear button || fr || upload_gallery'>Загрузить<svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></a>
            </div>
            <div class='clearfix || gallery_container'>
                <?php if ($galleryImg): ?>
                    <?php foreach ($galleryImg as $image): ?>
                        <div class='gallery_image' data-image-id="<?=$image['id']?>" id='image_<?=$image['id']?>'>
                            <div class='gallery_bg' style="background-image: url(<?=$image['image']?>)"></div>
                            <span class='gallery_delete'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_close'></use></svg></span>
                            <span class='gallery_move'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_move'></use></svg></span>
                            <div class='gallery_descr'>
                                <textarea name='image[<?=$image['id']?>]' placeholder='Description' class='input'><?=$image['name'] ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    Нету фотографий в данной галереи
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php
        $fg = false;
        $meta = [];

        foreach ($columns as $pr) {
            if (strpos($pr['field_name'], 'title') !== false  || strpos($pr['field_name'], 'keywords') !== false || strpos($pr['field_name'], 'description') !== false || strpos($pr['field_name'], 'url') !== false) {
                $fg = true;
                $meta [] = $pr;
            }
        }
        ?>

        <?php if ($fg): ?>
            <a href='#' class='show_meta || primary button || fl'>Мета Теги для Продвижения</a>
            <section class='meta_tags'>
                <div class='underlined h2'>Мета Теги </div>

                <?php $met_cnt = 0;?>
                <?php foreach ($meta as $met): ?>
                    <?php $met_cnt++; ?>
                    <?php if ($met_cnt % 2 == 1): ?>
                        <div class="row">
                    <?php endif;?>

                    <div class='col_6'>
                        <div class='pre_input'><?=$met['field_title'] ?> <div class='input_count'></div></div>
                        <input type='text' name='<?=$table?>[<?=$met['field_name'] ?>]' class='input || to_count' value="<?=$met['value'] ?>">
                    </div>

                    <?php if ($met_cnt % 2 == 0 || ($met_cnt % 2 == 1 && $met_cnt === count($meta))): ?>
                        </div>
                    <?php endif; ?>

                <?php endforeach;?>

            </section>
        <?php endif; ?>

        <button class='button || fr || save_button'>Сохранить</button>
        <button class='button || fr || preview_button'>Preview</button>
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
        url: '/kadmin/?c=edit&t=<?=$table ?>&r=<?=$columns['id']['value'] ?>',
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
                html += "<div class='gallery_bg' style='background-image: url(" + image.image + ")'></div>";
                html += "<span class='gallery_delete'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_close'></use></svg></span>";
                html += "<span class='gallery_move'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_move'></use></svg></span>";
                html += "<div class='gallery_descr'>";
                html += "<textarea name='image[" + image.id + "]' placeholder='Description' class='input'>" + image.name + "</textarea>";
                html += "</div>";
                html += "</div>";

                $('.gallery_container').append(html);
            }
        }
    });
</script>

<!-- Sort stuff -->
<form action="#" id="sformgallery" method="post" data-gallery-sort-pos>
    <input name="sortdatagallery" id="sortdatagallery" type="hidden" value=""/>
</form>

