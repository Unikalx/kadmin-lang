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
    <form data-edit-create="<?=$table?>" method='POST' class='clearfix' enctype="multipart/form-data">
        <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

            <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> КОМАНДЫ

            </span>


            <div class="row">
    <!-- name -->
                    <div class="col_6">
                        <div class="pre_input">Имя Человека</div>
                        <input type="text" name="<?=$table?>[name]" class="input" id="name" value="<?=$columns['name']?>">
                    </div>
            </div>
            <div class="row">
    <!-- thumbnail -->
                <div class="col_6 upload_file">
                        <!--file-->
                        <div data-table="<?=$table?>" data-field="thumbnail" data-<?=$table . '_thumbnail'?> class='pre_input' data-image-url="../pictures/<?=$table?>/<?=$columns['thumbnail']?>">Фото
                            <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                            <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                        </div>
                        <input data-table="<?=$table?>" data-field="thumbnail" type="file" name='thumbnail' id='<?=$table . '_thumbnail'?>' class="upload" data-multiple-caption="{count} files selected">
                        <label class='last_item' for="<?=$table . '_thumbnail'?>"><span class='file_name'><?=$columns['thumbnail']?></span><span class='file_deleted'>Удалить</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Выберите файл</strong></label>
                        <?php if ($columns['thumbnail']): ?>
                            <script>$('[data-<?=$table . '_thumbnail'?>] .delete_thumbnail, [data-<?=$table . '_thumbnail'?>] .watch_thumbnail').addClass('active')</script>
                        <?php endif; ?>
                </div>
				<div class="col_6">
                    <div class='clearfix'></div>
                    <div class='pre_input'>Позиция</div>
					<input type="text" name="<?=$table?>[field_1]" class="input" id="field_1" value="<?=$columns['field_1']?>">
                </div>  
            </div>
    <!-- value -->
                <div class="row">
                    <!--ckeditor-->
                    <div class='clearfix'></div>
                    <div class='pre_input'>Текст</div>
					<textarea data-ckeditor id='<?=$table?>_value' name="<?=$table?>[value]"><?=$columns['value']?></textarea>
                </div>      

        </section>
        <button class="button || fr || save_button">Сохранить</button>

        <?php if(isset($_GET['id']) && $_GET['id']!=''):?>
<!--            <a href="/--><?//=$url['url']?><!--" target="_blank" class="button || fr || preview_button">просмотр</a>-->
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
                html += "<div class='gallery_bg' style='background-image: url(/kadmin/image.php?width=250&height=250&cropratio=1:1&image=" + image.image + ")'></div>";
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

