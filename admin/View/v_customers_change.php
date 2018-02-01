<?php
/**
 * @var $table string
 * @var $columns array
 * @var $url array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" data-up-level-id="">
        <form data-edit-create="<?=$table?>" action="" method="POST" class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">

        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

        <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$table?> <?=$_GET['id'] ? 'редактирование' : 'добавление';?>

            </span>


            <div class="row">
                <?php if($settings['name']['on_off']):?>
    <!-- name -->
                    <div class="col_6">
                        <div class="pre_input"><?=$settings['name']['field_title'] ? $settings['name']['field_title'] : "name"?></div>
                        <input type="text" name="<?=$table?>[name]" class="input <?=$settings['name']['field_style'] ? $settings['name']['field_style'] : ""?>" id="name" value="<?=$columns['name']?>">
                    </div>
                <?php endif;?>
                <?php if($settings['email']['on_off']):?>
    <!-- email -->
                    <div class="col_6">
                        <div class="pre_input"><?=$settings['email']['field_title'] ? $settings['email']['field_title'] : "email"?></div>
                        <input type="text" name="<?=$table?>[email]" class="input <?=$settings['email']['field_style'] ? $settings['email']['field_style'] : ""?>" id="name" value="<?=$columns['email']?>">
                    </div>
                <?php endif;?>
            </div>
            <div class="row">
                <?php if($settings['phone']['on_off']):?>
    <!-- phone-->
                    <div class="col_6">
                        <div class="pre_input"><?=$settings['phone']['field_title'] ? $settings['phone']['field_title'] : "phone"?></div>
                        <input type="text" name="<?=$table?>[phone]" class="input <?=$settings['phone']['field_style'] ? $settings['phone']['field_style'] : ""?>" id="name" value="<?=$columns['phone']?>">
                    </div>
                <?php endif;?>
                <?php if($settings['city']['on_off']):?>
    <!-- city-->
                    <div class="col_6">
                        <div class="pre_input"><?=$settings['city']['field_title'] ? $settings['city']['field_title'] : "city"?></div>
                        <input type="text" name="<?=$table?>[city]" class="input <?=$settings['city']['field_style'] ? $settings['city']['field_style'] : ""?>" id="name" value="<?=$columns['city']?>">
                    </div>
                <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['province']['on_off']):?>
    <!-- province-->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['province']['field_title'] ? $settings['province']['field_title'] : "province"?></div>
                            <input type="text" name="<?=$table?>[province]" class="input <?=$settings['province']['field_style'] ? $settings['province']['field_style'] : ""?>" id="name" value="<?=$columns['province']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['postal']['on_off']):?>
    <!-- postal-->
                        <div class="col_6">
                            <div class="pre_input"><?=$settings['postal']['field_title'] ? $settings['postal']['field_title'] : "postal"?></div>
                            <input type="text" name="<?=$table?>[postal]" class="input <?=$settings['postal']['field_style']?>" id="name" value="<?=$columns['postal']?>">
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
                <div class="row">
                    <?php if($settings['background']['on_off']):?>
                        <div class="col_6 ">
    <!-- address -->
                            <div class="pre_input"><?=$settings['address']['field_title'] ? $settings['postal']['field_title'] : "address";?></div>
                            <input type="text" name="<?=$table?>[address]" class="input <?=$settings['postal']['field_style']?>" id="address" value="<?=$columns['address']?>">
                        </div>
                    <?php endif; ?>
                    <div class="col_6">
                        <!-- password -->
                        <div class="col_6">
                            <a href="#" class="button || fl || hide_pass"  style="<?= isset($_GET['id']) ? "" : "display:none;"?> margin-top: 3rem;">Change Password</a>
                            <div class="pass_block" <?= !isset($_GET['id']) ? "" : "style='display:none'"?>>
                                <!-- password -->
                                <div class="pre_input" >Password</div>
                                <input type="password" name="<?=$table?>[password]" class="input" id="password">
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <button class="button || fr || save_button">Сохранить</button>

            <?php if(!isset($_GET['id'])):?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>

        </form>
    </div>
</div>