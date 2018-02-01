<?php
/**
 * @var $table string
 * @var $url array
 * @var $columns array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?= $table ?>" data-up-level-id="<?= $columns['id_sect'] ?>">
        <form data-edit-create="<?= $table ?>" action="" method="POST"
              class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">

            <!-- якщо це редагування то виводиться id -->
            <input type="hidden" value="<?= $columns['id'] ?>" name="<?= $table ?>[id]">

            <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
                <span class="h1"><?= $_GET['id'] ? 'редактирование' : 'добавление'; ?> СЛАЙДА

            </span>


                <div class="row">
                    <?php if ($settings['name']['on_off']): ?>
                        <!-- name -->
                        <div class="col_6">
                            <div class="pre_input"><?= $settings['name']['field_title'] ? $settings['name']['field_title'] : "Имя слайда" ?></div>
                            <input type="text" name="<?= $table ?>[name]"
                                   class="input <?= $settings['name']['field_style'] ? $settings['name']['field_style'] : "" ?>"
                                   id="name" value="<?= $columns['name'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['checkbox']['on_off']): ?>
                        <!-- checkbox -->
                        <div class="col_6" style="margin-top: 3rem;">
                            <input class="<?= $settings['checkbox']['field_style'] ?>" value=1"
                                   name='<?= $table ?>[checkbox]' type='checkbox' value='<?= $columns['checkbox'] ?>'
                                   id='<?= $table ?>[checkbox]' <?= $columns['checkbox'] ? 'checked' : '' ?>>
                            <label for='<?= $table ?>[checkbox]'><?= $settings['checkbox']['field_title'] ? $settings['checkbox']['field_title'] : "checkbox" ?></label>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($settings['value']['on_off']): ?>
                    <!-- value -->
                    <div class="row">
                        <!--ckeditor-->
                        <div class='clearfix'></div>
                        <div class='pre_input'><?= $settings['value']['field_title'] ? $settings['value']['field_title'] : "Основной текст" ?></div>
                        <textarea <?= ($settings['value']['field_style'] != 'ckeditor' ? "class='" . $settings['value']['field_style'] . "'" : "data-ckeditor id='" . $table . "_value'") ?>
                                name="<?= $table ?>[value]"><?= $columns['value'] ?></textarea>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <?php if ($settings['field_1']['on_off']): ?>
                        <div class="col_6">
                            <!-- field_1 -->
                            <div class='pre_input'><?= $settings['field_1']['field_title'] ? $settings['field_1']['field_title'] : "field_1" ?></div>
                            <input type='text' name='<?= $table ?>[field_1]'
                                   class='input <?= $settings['field_1']['field_style'] ?>'
                                   value="<?= $columns['field_1'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_2']['on_off']): ?>
                        <div class="col_6">
                            <!-- field_2 -->
                            <div class='pre_input'><?= $settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2" ?></div>
                            <input type='text' name='<?= $table ?>[field_2]'
                                   class='input <?= $settings['field_2']['field_style'] ?>'
                                   value="<?= $columns['field_2'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_3']['on_off']): ?>
                        <div class="col_6">
                            <!-- field_3 -->
                            <div class='pre_input'><?= $settings['field_3']['field_title'] ? $settings['field_3']['field_title'] : "field_3" ?></div>
                            <input type='text' name='<?= $table ?>[field_3]'
                                   class='input <?= $settings['field_3']['field_style'] ?>'
                                   value="<?= $columns['field_3'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_4']['on_off']): ?>
                        <div class="col_6">
                            <!-- field_4 -->
                            <div class='pre_input'><?= $settings['field_4']['field_title'] ? $settings['field_4']['field_title'] : "field_4" ?></div>
                            <input type='text' name='<?= $table ?>[field_4]'
                                   class='input <?= $settings['field_4']['field_style'] ?>'
                                   value="<?= $columns['field_4'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['image1']['on_off']): ?>
                        <!-- image1 -->
                        <div class="col_6 upload_file">
                            <!--file-->
                            <div data-table="<?= $table ?>" data-field="image1" data-<?= $table . '_image1' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['image1'] ?>"><?= $settings['image1']['field_title'] ? $settings['image1']['field_title'] : "image1"; ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?= $table ?>" data-field="image1" type="file" name='image1'
                                   id='<?= $table . '_image1' ?>'
                                   class="upload <?= $settings['image1']['field_style'] ?>"
                                   data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?= $table . '_image1' ?>"><span
                                        class='file_name'><?= $columns['image1'] ?></span><span class='file_deleted'>Удалить</span><strong>
                                    <svg class='icon'>
                                        <use xlink:href='View/img/svgdefs.svg#icon_upload'></use>
                                    </svg>
                                    </svg>Выберите файл</strong></label>
                            <?php if ($columns['image1']): ?>
                                <script>$('[data-<?=$table . '_image1'?>] .delete_thumbnail, [data-<?=$table . '_image1'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                    <?php if ($settings['image2']['on_off']): ?>
                        <!-- image2 -->
                        <div class="col_6 upload_file">
                            <!--file-->
                            <div data-table="<?= $table ?>" data-field="image2" data-<?= $table . '_image2' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['image2'] ?>"><?= $settings['image2']['field_title'] ? $settings['image2']['field_title'] : "image2"; ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?= $table ?>" data-field="image2" type="file" name='image2'
                                   id='<?= $table . '_image2' ?>'
                                   class="upload <?= $settings['image2']['field_style'] ?>"
                                   data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?= $table . '_image2' ?>"><span
                                        class='file_name'><?= $columns['image2'] ?></span><span class='file_deleted'>Удалить</span><strong>
                                    <svg class='icon'>
                                        <use xlink:href='View/img/svgdefs.svg#icon_upload'></use>
                                    </svg>
                                    </svg>Выберите файл</strong></label>
                            <?php if ($columns['image2']): ?>
                                <script>$('[data-<?=$table . '_image2'?>] .delete_thumbnail, [data-<?=$table . '_image2'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php /**
                 *****TRANSLATE*****
                 */ ?>
                <hr/>
                <div class="button_lang col_12">
                    <a href="#" button="ua" class="button active_button" onclick="return false;">Укр</a>
                    <a href="#" button="ru" class="button" onclick="return false;">Рус</a>
                    <a href="#" button="en" class="button" onclick="return false;">Eng</a>
                </div>
                <?php
                /**
                 *********************
                 *******LANG UA*******
                 *********************
                 */
                ?>
                <div langSections="ua">
                    <?php if ($settingsTranslate['name']['on_off'] OR !isset($_GET['id'])): ?>
                        <!-- name -->
                        <div class="row">
                            <div class="col_6">
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Имя секции" ?>
                                    UA
                                </div>
                                <input type="text" nameInput="ua" name="<?= $table ?>[uaname]"
                                       class="input <?= $settingsTranslate['name']['field_style'] ? $settingsTranslate['name']['field_style'] : "" ?>"
                                       value='<?= $columnsUA['name'] ?>'>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php if ($settingsTranslate['field_1']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_1 -->
                                <div class='pre_input'><?= $settingsTranslate['field_1']['field_title'] ? $settingsTranslate['field_1']['field_title'] : "field_1" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_1]'
                                       class='input <?= $settingsTranslate['field_1']['field_style'] ? $settingsTranslate['field_1']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_1'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_2']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_2 -->
                                <div class='pre_input'><?= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_1" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_2]'
                                       class='input <?= $settingsTranslate['field_2']['field_style'] ? $settingsTranslate['field_2']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_2'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_3']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_3 -->
                                <div class='pre_input'><?= $settingsTranslate['field_3']['field_title'] ? $settingsTranslate['field_3']['field_title'] : "field_3" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_3]'
                                       class='input <?= $settingsTranslate['field_3']['field_style'] ? $settingsTranslate['field_3']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_3'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_4']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_4 -->
                                <div class='pre_input'><?= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_4]'
                                       class='input <?= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_4'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_5']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_5 -->
                                <div class='pre_input'><?= $settingsTranslate['field_5']['field_title'] ? $settingsTranslate['field_5']['field_title'] : "field_5" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_5]'
                                       class='input <?= $settingsTranslate['field_5']['field_style'] ? $settingsTranslate['field_5']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_5'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_6']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_6 -->
                                <div class='pre_input'><?= $settingsTranslate['field_6']['field_title'] ? $settingsTranslate['field_6']['field_title'] : "field_6" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_6]'
                                       class='input <?= $settingsTranslate['field_6']['field_style'] ? $settingsTranslate['field_6']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_6'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_7']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_7 -->
                                <div class='pre_input'><?= $settingsTranslate['field_7']['field_title'] ? $settingsTranslate['field_7']['field_title'] : "field_7" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_7]'
                                       class='input <?= $settingsTranslate['field_7']['field_style'] ? $settingsTranslate['field_7']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_7'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($settingsTranslate['value_1']['on_off']): ?>
                        <div class="row">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_1']['field_title'] ? $settingsTranslate['value_1']['field_title'] : "value_1" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_1']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_1'") ?>
                                    name="<?= $table ?>[uavalue_1]"><?= $columnsUA['value_1'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_2']['on_off']): ?>
                        <!-- value_2 -->
                        <div class="row <?= $settingsTranslate['value_2']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_2'") ?>
                                    name="<?= $table ?>[uavalue_2]"><?= $columnsUA['value_2'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_3']['on_off']): ?>
                        <!-- value_3 -->
                        <div class="row">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_3'") ?>
                                    name="<?= $table ?>[uavalue_3]"><?= $columnsUA['value_3'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_4']['on_off']): ?>
                        <!-- value_4 -->
                        <div class="row <?= $settingsTranslate['value_4']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_4'") ?>
                                    name="<?= $table ?>[uavalue_4]"><?= $columnsUA['value_4'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_5']['on_off']): ?>
                        <!-- value_5 -->
                        <div class="row <?= $settingsTranslate['value_5']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_5'") ?>
                                    name="<?= $table ?>[uavalue_5]"><?= $columnsUA['value_5'] ?></textarea>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                /**
                 *********************
                 *******LANG RU*******
                 *********************
                 */ ?>
                <div langSections="ru" style="display: none;">
                    <?php if ($settingsTranslate['name']['on_off'] OR !isset($_GET['id'])): ?>
                        <!-- name -->
                        <div class="row">
                            <div class="col_6">
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Имя секции" ?>
                                    RU
                                </div>
                                <input type="text" nameInput="ru" name="<?= $table ?>[runame]"
                                       class="input <?= $settingsTranslate['name']['field_style'] ? $settingsTranslate['name']['field_style'] : "" ?>"
                                       value='<?= $columnsRU['name'] ?>'>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php if ($settingsTranslate['field_1']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_1 -->
                                <div class='pre_input'><?= $settingsTranslate['field_1']['field_title'] ? $settingsTranslate['field_1']['field_title'] : "field_1" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_1]'
                                       class='input <?= $settingsTranslate['field_1']['field_style'] ? $settingsTranslate['field_1']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_1'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_2']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_2 -->
                                <div class='pre_input'><?= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_1" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_2]'
                                       class='input <?= $settingsTranslate['field_2']['field_style'] ? $settingsTranslate['field_2']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_2'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_3']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_3 -->
                                <div class='pre_input'><?= $settingsTranslate['field_3']['field_title'] ? $settingsTranslate['field_3']['field_title'] : "field_3" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_3]'
                                       class='input <?= $settingsTranslate['field_3']['field_style'] ? $settingsTranslate['field_3']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_3'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_4']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_4 -->
                                <div class='pre_input'><?= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_4]'
                                       class='input <?= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_4'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_5']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_5 -->
                                <div class='pre_input'><?= $settingsTranslate['field_5']['field_title'] ? $settingsTranslate['field_5']['field_title'] : "field_5" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_5]'
                                       class='input <?= $settingsTranslate['field_5']['field_style'] ? $settingsTranslate['field_5']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_5'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_6']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_6 -->
                                <div class='pre_input'><?= $settingsTranslate['field_6']['field_title'] ? $settingsTranslate['field_6']['field_title'] : "field_6" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_6]'
                                       class='input <?= $settingsTranslate['field_6']['field_style'] ? $settingsTranslate['field_6']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_6'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_7']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_7 -->
                                <div class='pre_input'><?= $settingsTranslate['field_7']['field_title'] ? $settingsTranslate['field_7']['field_title'] : "field_7" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_7]'
                                       class='input <?= $settingsTranslate['field_7']['field_style'] ? $settingsTranslate['field_7']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_7'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($settingsTranslate['value_1']['on_off']): ?>
                        <!-- value_1 -->
                        <div class="row">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_1']['field_title'] ? $settingsTranslate['value_1']['field_title'] : "value_1" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_1']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_1'") ?>
                                    name="<?= $table ?>[ruvalue_1]"><?= $columnsRU['value_1'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_2']['on_off']): ?>
                        <!-- value_2 -->
                        <div class="row <?= $settingsTranslate['value_2']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_2'") ?>
                                    name="<?= $table ?>[ruvalue_2]"><?= $columnsRU['value_2'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_3']['on_off']): ?>
                        <!-- value_3 -->
                        <div class="row">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_3'") ?>
                                    name="<?= $table ?>[ruvalue_3]"><?= $columnsRU['value_3'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_4']['on_off']): ?>
                        <!-- value_4 -->
                        <div class="row <?= $settingsTranslate['value_4']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_4'") ?>
                                    name="<?= $table ?>[ruvalue_4]"><?= $columnsRU['value_4'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_5']['on_off']): ?>
                        <!-- value_5 -->
                        <div class="row <?= $settingsTranslate['value_5']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_5'") ?>
                                    name="<?= $table ?>[ruvalue_5]"><?= $columnsRU['value_5'] ?></textarea>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                /**
                 *********************
                 *******LANG EN*******
                 *********************
                 */ ?>
                <div langSections="en" style="display: none;">
                    <?php if ($settingsTranslate['name']['on_off'] OR !isset($_GET['id'])): ?>
                        <!-- name -->
                        <div class="row">
                            <div class="col_6">
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Имя секции" ?>
                                    EN
                                </div>
                                <input type="text" nameInput="en" name="<?= $table ?>[enname]"
                                       class="input <?= $settingsTranslate['name']['field_style'] ? $settingsTranslate['name']['field_style'] : "" ?>"
                                       value='<?= $columnsEN['name'] ?>'>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php if ($settingsTranslate['field_1']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_1 -->
                                <div class='pre_input'><?= $settingsTranslate['field_1']['field_title'] ? $settingsTranslate['field_1']['field_title'] : "field_1" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_1]'
                                       class='input <?= $settingsTranslate['field_1']['field_style'] ? $settingsTranslate['field_1']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_1'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_2']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_2 -->
                                <div class='pre_input'><?= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_1" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_2]'
                                       class='input <?= $settingsTranslate['field_2']['field_style'] ? $settingsTranslate['field_2']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_2'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_3']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_3 -->
                                <div class='pre_input'><?= $settingsTranslate['field_3']['field_title'] ? $settingsTranslate['field_3']['field_title'] : "field_3" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_3]'
                                       class='input <?= $settingsTranslate['field_3']['field_style'] ? $settingsTranslate['field_3']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_3'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_4']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_4 -->
                                <div class='pre_input'><?= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_4]'
                                       class='input <?= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_4'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_5']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_5 -->
                                <div class='pre_input'><?= $settingsTranslate['field_5']['field_title'] ? $settingsTranslate['field_5']['field_title'] : "field_5" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_5]'
                                       class='input <?= $settingsTranslate['field_5']['field_style'] ? $settingsTranslate['field_5']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_5'] ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($settingsTranslate['field_6']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_6 -->
                                <div class='pre_input'><?= $settingsTranslate['field_6']['field_title'] ? $settingsTranslate['field_6']['field_title'] : "field_6" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_6]'
                                       class='input <?= $settingsTranslate['field_6']['field_style'] ? $settingsTranslate['field_6']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_6'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php if ($settingsTranslate['field_7']['on_off']): ?>
                            <div class="col_6">
                                <!-- field_7 -->
                                <div class='pre_input'><?= $settingsTranslate['field_7']['field_title'] ? $settingsTranslate['field_7']['field_title'] : "field_7" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_7]'
                                       class='input <?= $settingsTranslate['field_7']['field_style'] ? $settingsTranslate['field_7']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_7'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($settingsTranslate['value_1']['on_off']): ?>
                        <!-- value_1 -->
                        <div class="row">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_1']['field_title'] ? $settingsTranslate['value_1']['field_title'] : "value_1" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_1']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_1'") ?>
                                    name="<?= $table ?>[envalue_1]"><?= $columnsEN['value_1'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_2']['on_off']): ?>
                        <!-- value_2 -->
                        <div class="row <?= $settingsTranslate['value_2']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_2'") ?>
                                    name="<?= $table ?>[envalue_2]"><?= $columnsEN['value_2'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_3']['on_off']): ?>
                        <!-- value_3 -->
                        <div class="row">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_3'") ?>
                                    name="<?= $table ?>[envalue_3]"><?= $columnsEN['value_3'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_4']['on_off']): ?>
                        <!-- value_4 -->
                        <div class="row <?= $settingsTranslate['value_4']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_4'") ?>
                                    name="<?= $table ?>[envalue_4]"><?= $columnsEN['value_4'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_5']['on_off']): ?>
                        <!-- value_5 -->
                        <div class="row <?= $settingsTranslate['value_5']['on_off'] ? "" : "none" ?>">
                            <!--ckeditor-->
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_5'") ?>
                                    name="<?= $table ?>[envalue_5]"><?= $columnsEN['value_5'] ?></textarea>
                        </div>
                    <?php endif; ?>
                </div>
                <?php /**
                 *****END*****
                 */ ?>
            </section>

            <button class="button || fr || save_button">Сохранить</button>

            <?php if (isset($_GET['id']) && $_GET['id'] != ''): ?>
                <a href="/<?= $url['url'] ?>" target="_blank" class="button || fr || preview_button">просмотр</a>
            <?php else: ?>
                <input type="submit" name="save_close" value="Сохранить и закрыть"
                       class="button || fr || preview_button">
            <?php endif; ?>


        </form>
    </div>
</div>