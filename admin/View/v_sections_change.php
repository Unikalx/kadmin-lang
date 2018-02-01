<?php
/**
 * @var $table string
 * @var $columns array
 * @var $columnsUA array
 * @var $columnsRU array
 * @var $columnsEN array
 * @var $url array
 */


?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?= $table ?>" data-up-level-id="">
        <form data-edit-create="<?= $table ?>" action="" method="POST"
              class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">
            <!--            <input type="hidden" name="products[id_category]" value="13">-->
            <!--            <input type="hidden" value="products" name="table">-->
            <!---->
            <!-- якщо це редагування то виводиться id -->
            <input type="hidden" value="<?= $columns['id'] ?>" name="<?= $table ?>[id]">
            <section>
                <span class="h1"><?= $_GET['id'] ? 'редактирование' : 'добавление'; ?> Секции
            </span>
                <div class="row">
                    <div class="col_6">
                        <div class="row" style="padding-top: 2rem;">
                            <?php if ($_SESSION['authorize']['status'] == 1) : ?>
                                <div class="col_6">
                                    <input name='<?= $table ?>[landing]' type='checkbox'
                                           class="checkbox <?= $settings['landing']['field_style'] ?>"
                                           value='<?= $columns['landing'] ?>'
                                           id='<?= $table ?>[landing]' <?= $columns['landing'] ? 'checked' : '' ?>>
                                    <label for='<?= $table ?>[landing]'><?= $settings['landing']['field_title'] ? $settings['landing']['field_title'] : "landing" ?></label>
                                </div>
                            <?php else: ?>
                                <input name='<?= $table ?>[landing]' type='hidden' value='<?= $columns['landing'] ?>'>
                            <?php endif ?>
                            <?php if ($settings['checkbox']['on_off']): ?>
                                <div class="col_6" style="padding-top: 3.5rem;">
                                    <input name='<?= $table ?>[checkbox]' type='checkbox'
                                           class="checkbox <?= $settings['checkbox']['field_style']; ?>"
                                           value='<?= $columns['checkbox'] ?>'
                                           id='<?= $table ?>[checkbox]' <?= $columns['checkbox'] ? 'checked' : '' ?>>
                                    <label for='<?= $table ?>[checkbox]'><?= $settings['date']['field_title'] ? $settings['date']['field_title'] : "checkbox"; ?></label>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($_SESSION['authorize']['status'] == 1) : ?>
                            <div class="row">
                                <input name='<?= $table ?>[has_subsect]' type='checkbox'
                                       class="checkbox  <?= $settings['has_subsect']['field_style']; ?>"
                                       value='<?= $columns['has_subsect'] ?>'
                                       id='<?= $table ?>[has_subsect]' <?= $columns['has_subsect'] ? 'checked' : '' ?>>
                                <label for='<?= $table ?>[has_subsect]'><?= $settings['has_subsect']['field_title'] ? $settings['has_subsect']['field_title'] : "has_subsect" ?></label>
                            </div>
                        <?php else: ?>
                            <input name='<?= $table ?>[has_subsect]' type='hidden'
                                   value='<?= $columns['has_subsect'] ?>'>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row">
                    <?php if ($settings['thumbnail']['on_off']): ?>
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="thumbnail" data-<?= $table . '_thumbnail' ?>
                                 class='pre_input'
                                 data-image-url="../pictures/<?= $table ?>/<?= $columns['thumbnail'] ?>"><?= $settings['thumbnail']['field_title'] ? $settings['thumbnail']['field_title'] : "thumbnail" ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?= $table ?>" data-field="thumbnail" type="file" name='thumbnail'
                                   id='<?= $table . '_thumbnail' ?>'
                                   class="upload <?= $settings['thumbnail']['field_style'] ? $settings['thumbnail']['field_style'] : "" ?>"
                                   data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?= $table . '_thumbnail' ?>"><span
                                        class='file_name'><?= $columns['thumbnail'] ?></span><span class='file_deleted'>Удалить</span><strong>
                                    <svg class='icon'>
                                        <use xlink:href='View/img/svgdefs.svg#icon_upload'></use>
                                    </svg>
                                    </svg>Выберите файл</strong></label>
                            <?php if ($columns['thumbnail']): ?>
                                <script>$('[data-<?=$table . '_thumbnail'?>] .delete_thumbnail, [data-<?=$table . '_thumbnail'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                    <?php if ($settings['background']['on_off']): ?>
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="background" data-<?= $table . '_background' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['background'] ?>"><?= $settings['background']['field_title'] ? $settings['background']['field_title'] : "background" ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?= $table ?>" data-field="background" type="file" name='background'
                                   id='<?= $table . '_background' ?>'
                                   class="upload <?= $settings['background']['field_style'] ? $settings['background']['field_style'] : "" ?>"
                                   data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?= $table . '_background' ?>"><span
                                        class='file_name'><?= $columns['background'] ?></span><span
                                        class='file_deleted'>Удалить</span><strong>
                                    <svg class='icon'>
                                        <use xlink:href='View/img/svgdefs.svg#icon_upload'></use>
                                    </svg>
                                    </svg>Выберите файл&hellip;</strong></label>
                            <?php if ($columns['background']): ?>
                                <script>$('[data-<?=$table . '_background'?>] .delete_thumbnail, [data-<?=$table . '_background'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['image_1']['on_off']): ?>
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="image_1" data-<?= $table . '_image_1' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['image_1'] ?>"><?= $settings['image_1']['field_title'] ? $settings['image_1']['field_title'] : "image_1"; ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?= $table ?>" data-field="image_1" type="file" name='image_1'
                                   id='<?= $table . '_image_1' ?>'
                                   class="upload <?= $settings['image_1']['field_style'] ?>"
                                   data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?= $table . '_image_1' ?>"><span
                                        class='file_name'><?= $columns['image_1'] ?></span><span class='file_deleted'>Удалить</span><strong>
                                    <svg class='icon'>
                                        <use xlink:href='View/img/svgdefs.svg#icon_upload'></use>
                                    </svg>
                                    </svg>Выберите файл</strong></label>
                            <?php if ($columns['image_1']): ?>
                                <script>$('[data-<?=$table . '_image_1'?>] .delete_thumbnail, [data-<?=$table . '_image_1'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['image_2']['on_off']): ?>
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="image_2" data-<?= $table . '_image_2' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['image_2'] ?>"><?= $settings['image_2']['field_title'] ? $settings['image_2']['field_title'] : "image_2"; ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                            </div>
                            <input data-table="<?= $table ?>" data-field="image_2" type="file" name='image_2'
                                   id='<?= $table . '_image_2' ?>'
                                   class="upload <?= $settings['image_2']['field_style'] ?>"
                                   data-multiple-caption="{count} files selected">
                            <label class='last_item' for="<?= $table . '_image_2' ?>"><span
                                        class='file_name'><?= $columns['image_2'] ?></span><span class='file_deleted'>Удалить</span><strong>
                                    <svg class='icon'>
                                        <use xlink:href='View/img/svgdefs.svg#icon_upload'></use>
                                    </svg>
                                    </svg>Выберите файл</strong></label>
                            <?php if ($columns['image_2']): ?>
                                <script>$('[data-<?=$table . '_image_2'?>] .delete_thumbnail, [data-<?=$table . '_image_2'?>] .watch_thumbnail').addClass('active')</script>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_1']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_1']['field_title'] ? $settings['field_1']['field_title'] : "field_1" ?></div>
                            <input type='text' name='<?= $table ?>[field_1]'
                                   class='input <?= $settings['field_1']['field_style'] ? $settings['field_1']['field_style'] : "" ?>'
                                   value="<?= $columns['field_1'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_2']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2" ?></div>
                            <input type='text' name='<?= $table ?>[field_2]'
                                   class='input <?= $settings['field_2']['field_style'] ? $settings['field_2']['field_style'] : "" ?>'
                                   value="<?= $columns['field_2'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_3']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_3']['field_title'] ? $settings['field_3']['field_title'] : "field_3" ?></div>
                            <input type='text' name='<?= $table ?>[field_3]'
                                   class='input <?= $settings['field_3']['field_style'] ? $settings['field_3']['field_style'] : "" ?>'
                                   value="<?= $columns['field_3'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_4']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_4']['field_title'] ? $settings['field_4']['field_title'] : "field_4" ?></div>
                            <input type='text' name='<?= $table ?>[field_4]'
                                   class='input <?= $settings['field_4']['field_style'] ? $settings['field_4']['field_style'] : "" ?>'
                                   value="<?= $columns['field_4'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_5']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_5']['field_title'] ? $settings['field_5']['field_title'] : "field_5" ?></div>
                            <input type='text' name='<?= $table ?>[field_5]'
                                   class='input <?= $settings['field_5']['field_style'] ? $settings['field_5']['field_style'] : "" ?>'
                                   value="<?= $columns['field_5'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_6']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_6']['field_title'] ? $settings['field_6']['field_title'] : "field_6" ?></div>
                            <input type='text' name='<?= $table ?>[field_6]'
                                   class='input <?= $settings['field_6']['field_style'] ? $settings['field_6']['field_style'] : "" ?>'
                                   value="<?= $columns['field_6'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_7']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_7']['field_title'] ? $settings['field_7']['field_title'] : "field_7" ?></div>
                            <input type='text' name='<?= $table ?>[field_7]'
                                   class='input <?= $settings['field_7']['field_style'] ? $settings['field_7']['field_style'] : "" ?>'
                                   value="<?= $columns['field_7'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_8']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_8']['field_title'] ? $settings['field_8']['field_title'] : "field_8" ?></div>
                            <input type='text' name='<?= $table ?>[field_8]'
                                   class='input <?= $settings['field_8']['field_style'] ? $settings['field_8']['field_style'] : "" ?>'
                                   value="<?= $columns['field_8'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_9']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_9']['field_title'] ? $settings['field_9']['field_title'] : "field_9" ?></div>
                            <input type='text' name='<?= $table ?>[field_9]'
                                   class='input <?= $settings['field_9']['field_style'] ? $settings['field_9']['field_style'] : "" ?>'
                                   value="<?= $columns['field_9'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_10']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_10']['field_title'] ? $settings['field_10']['field_title'] : "field_10" ?></div>
                            <input type='text' name='<?= $table ?>[field_10]'
                                   class='input <?= $settings['field_10']['field_style'] ? $settings['field_10']['field_style'] : "" ?>'
                                   value="<?= $columns['field_10'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_11']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_11']['field_title'] ? $settings['field_11']['field_title'] : "field_11" ?></div>
                            <input type='text' name='<?= $table ?>[field_11]'
                                   class='input <?= $settings['field_11']['field_style'] ? $settings['field_11']['field_style'] : "" ?>'
                                   value="<?= $columns['field_11'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_12']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_12']['field_title'] ? $settings['field_12']['field_title'] : "field_12" ?></div>
                            <input type='text' name='<?= $table ?>[field_12]'
                                   class='input <?= $settings['field_12']['field_style'] ? $settings['field_12']['field_style'] : "" ?>'
                                   value="<?= $columns['field_12'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_13']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_13']['field_title'] ? $settings['field_13']['field_title'] : "field_13" ?></div>
                            <input type='text' name='<?= $table ?>[field_13]'
                                   class='input <?= $settings['field_13']['field_style'] ? $settings['field_13']['field_style'] : "" ?>'
                                   value="<?= $columns['field_13'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_14']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_14']['field_title'] ? $settings['field_14']['field_title'] : "field_14" ?></div>
                            <input type='text' name='<?= $table ?>[field_14]'
                                   class='input <?= $settings['field_14']['field_style'] ? $settings['field_14']['field_style'] : "" ?>'
                                   value="<?= $columns['field_14'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_15']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_15']['field_title'] ? $settings['field_15']['field_title'] : "field_15" ?></div>
                            <input type='text' name='<?= $table ?>[field_15]'
                                   class='input <?= $settings['field_15']['field_style'] ? $settings['field_15']['field_style'] : "" ?>'
                                   value="<?= $columns['field_15'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_16']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_16']['field_title'] ? $settings['field_16']['field_title'] : "field_16" ?></div>
                            <input type='text' name='<?= $table ?>[field_16]'
                                   class='input <?= $settings['field_16']['field_style'] ? $settings['field_16']['field_style'] : "" ?>'
                                   value="<?= $columns['field_16'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_17']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_17']['field_title'] ? $settings['field_17']['field_title'] : "field_17" ?></div>
                            <input type='text' name='<?= $table ?>[field_17]'
                                   class='input <?= $settings['field_17']['field_style'] ? $settings['field_17']['field_style'] : "" ?>'
                                   value="<?= $columns['field_17'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($settings['value_1']['on_off']): ?>
                    <div class="row">
                        <div class='clearfix'></div>
                        <div class='pre_input'><?= $settings['value_1']['field_title'] ? $settings['value_1']['field_title'] : "value_1" ?></div>
                        <textarea <?= ($settings['value_1']['field_style'] != 'ckeditor' ? "class='" . $settings['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_value_1'") ?>
                                name="<?= $table ?>[value_1]"><?= $columns['value_1'] ?></textarea>
                    </div>
                <?php endif; ?>
                <?php if ($settings['value_2']['on_off']): ?>
                    <div class="row <?= $settings['value_2']['on_off'] ? "" : "none" ?>">
                        <div class='clearfix'></div>
                        <div class='pre_input'><?= $settings['value_2']['field_title'] ? $settings['value_2']['field_title'] : "value_2" ?></div>
                        <textarea <?= ($settings['value_2']['field_style'] != 'ckeditor' ? "class='" . $settings['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_value_2'") ?>
                                name="<?= $table ?>[value_2]"><?= $columns['value_2'] ?></textarea>
                    </div>
                <?php endif; ?>
                <?php /**
                 *****TRANSLATE*****
                 */ ?>
                <hr/>
                <div class="button_lang col_12">
                    <?php
                    foreach (LANG as $key => $item) { ?>
                        <a href="#" button="<?= $item ?>" class="button <?= ($key == 1) ? "active_button" : "" ?>"
                           onclick="return false;"><?= $item ?></a>
                    <?php } ?>
                    <!--                    <a href="#" button="ua" class="button active_button" onclick="return false;">Укр</a>-->
                    <!--                    <a href="#" button="ru" class="button" onclick="return false;">Рус</a>-->
                    <!--                    <a href="#" button="en" class="button" onclick="return false;">Eng</a>-->
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
                                <div class='pre_input'><?= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_2" ?>
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
                                <div class='pre_input'><?= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" ?>
                                    UA
                                </div>
                                <input type='text' name='<?= $table ?>[uafield_4]'
                                       class='input <?= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" ?>'
                                       value="<?= $columnsUA['field_4'] ?>">
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
                        <div class="row <?= $settingsTranslate['value_2']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_2'") ?>
                                    name="<?= $table ?>[uavalue_2]"><?= $columnsUA['value_2'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_3']['on_off']): ?>
                        <div class="row">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_3'") ?>
                                    name="<?= $table ?>[uavalue_3]"><?= $columnsUA['value_3'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_4']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_4']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_4'") ?>
                                    name="<?= $table ?>[uavalue_4]"><?= $columnsUA['value_4'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_5']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_5']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_5'") ?>
                                    name="<?= $table ?>[uavalue_5]"><?= $columnsUA['value_5'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_6']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_6']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_6']['field_title'] ? $settingsTranslate['value_6']['field_title'] : "value_6" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_6']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_6']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_6'") ?>
                                    name="<?= $table ?>[uavalue_6]"><?= $columnsUA['value_6'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_7']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_7']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_7']['field_title'] ? $settingsTranslate['value_7']['field_title'] : "value_7" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_7']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_7']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_7'") ?>
                                    name="<?= $table ?>[uavalue_7]"><?= $columnsUA['value_7'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_8']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_8']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_8']['field_title'] ? $settingsTranslate['value_8']['field_title'] : "value_8" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_8']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_8']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_8'") ?>
                                    name="<?= $table ?>[uavalue_8]"><?= $columnsUA['value_8'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_9']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_9']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_9']['field_title'] ? $settingsTranslate['value_9']['field_title'] : "value_9" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_9']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_9']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_9'") ?>
                                    name="<?= $table ?>[uavalue_9]"><?= $columnsUA['value_9'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_10']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_10']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_10']['field_title'] ? $settingsTranslate['value_10']['field_title'] : "value_10" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_10']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_10']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_10'") ?>
                                    name="<?= $table ?>[uavalue_10]"><?= $columnsUA['value_10'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_11']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_11']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_11']['field_title'] ? $settingsTranslate['value_11']['field_title'] : "value_11" ?>
                                UA
                            </div>
                            <textarea <?= ($settingsTranslate['value_11']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_11']['field_style'] . "'" : "data-ckeditor id='" . $table . "_uavalue_11'") ?>
                                    name="<?= $table ?>[uavalue_11]"><?= $columnsUA['value_11'] ?></textarea>
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
                                <div class='pre_input'><?= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_2" ?>
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
                                <div class='pre_input'><?= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" ?>
                                    RU
                                </div>
                                <input type='text' name='<?= $table ?>[rufield_4]'
                                       class='input <?= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" ?>'
                                       value="<?= $columnsRU['field_4'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($settingsTranslate['value_1']['on_off']): ?>
                        <div class="row">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_1']['field_title'] ? $settingsTranslate['value_1']['field_title'] : "value_1" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_1']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_1'") ?>
                                    name="<?= $table ?>[ruvalue_1]"><?= $columnsRU['value_1'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_2']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_2']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_2'") ?>
                                    name="<?= $table ?>[ruvalue_2]"><?= $columnsRU['value_2'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_3']['on_off']): ?>
                        <div class="row">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_3'") ?>
                                    name="<?= $table ?>[ruvalue_3]"><?= $columnsRU['value_3'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_4']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_4']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_4'") ?>
                                    name="<?= $table ?>[ruvalue_4]"><?= $columnsRU['value_4'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_5']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_5']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_5'") ?>
                                    name="<?= $table ?>[ruvalue_5]"><?= $columnsRU['value_5'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_6']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_6']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_6']['field_title'] ? $settingsTranslate['value_6']['field_title'] : "value_6" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_6']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_6']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_6'") ?>
                                    name="<?= $table ?>[ruvalue_6]"><?= $columnsRU['value_6'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_7']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_7']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_7']['field_title'] ? $settingsTranslate['value_7']['field_title'] : "value_7" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_7']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_7']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_7'") ?>
                                    name="<?= $table ?>[ruvalue_7]"><?= $columnsRU['value_7'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_8']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_8']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_8']['field_title'] ? $settingsTranslate['value_8']['field_title'] : "value_8" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_8']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_8']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_8'") ?>
                                    name="<?= $table ?>[ruvalue_8]"><?= $columnsRU['value_8'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_9']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_9']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_9']['field_title'] ? $settingsTranslate['value_9']['field_title'] : "value_9" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_9']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_9']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_9'") ?>
                                    name="<?= $table ?>[ruvalue_9]"><?= $columnsRU['value_9'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_10']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_10']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_10']['field_title'] ? $settingsTranslate['value_10']['field_title'] : "value_10" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_10']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_10']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_10'") ?>
                                    name="<?= $table ?>[ruvalue_10]"><?= $columnsRU['value_10'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_11']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_11']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_11']['field_title'] ? $settingsTranslate['value_11']['field_title'] : "value_11" ?>
                                RU
                            </div>
                            <textarea <?= ($settingsTranslate['value_11']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_11']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_11'") ?>
                                    name="<?= $table ?>[ruvalue_11]"><?= $columnsRU['value_11'] ?></textarea>
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
                                <div class='pre_input'><?= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_2" ?>
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
                                <div class='pre_input'><?= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" ?>
                                    EN
                                </div>
                                <input type='text' name='<?= $table ?>[enfield_4]'
                                       class='input <?= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" ?>'
                                       value="<?= $columnsEN['field_4'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($settingsTranslate['value_1']['on_off']): ?>
                        <div class="row">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_1']['field_title'] ? $settingsTranslate['value_1']['field_title'] : "value_1" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_1']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_1'") ?>
                                    name="<?= $table ?>[envalue_1]"><?= $columnsEN['value_1'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_2']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_2']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_2'") ?>
                                    name="<?= $table ?>[envalue_2]"><?= $columnsEN['value_2'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_3']['on_off']): ?>
                        <div class="row">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_3'") ?>
                                    name="<?= $table ?>[envalue_3]"><?= $columnsEN['value_3'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_4']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_4']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_4'") ?>
                                    name="<?= $table ?>[envalue_4]"><?= $columnsEN['value_4'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_5']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_5']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_5'") ?>
                                    name="<?= $table ?>[envalue_5]"><?= $columnsEN['value_5'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_6']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_6']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_6']['field_title'] ? $settingsTranslate['value_6']['field_title'] : "value_6" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_6']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_6']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_6'") ?>
                                    name="<?= $table ?>[envalue_6]"><?= $columnsEN['value_6'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_7']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_7']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_7']['field_title'] ? $settingsTranslate['value_7']['field_title'] : "value_7" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_7']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_7']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_7'") ?>
                                    name="<?= $table ?>[envalue_7]"><?= $columnsEN['value_7'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_8']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_8']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_8']['field_title'] ? $settingsTranslate['value_8']['field_title'] : "value_8" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_8']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_8']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_8'") ?>
                                    name="<?= $table ?>[envalue_8]"><?= $columnsEN['value_8'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_9']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_9']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_9']['field_title'] ? $settingsTranslate['value_9']['field_title'] : "value_9" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_9']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_9']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_9'") ?>
                                    name="<?= $table ?>[envalue_9]"><?= $columnsEN['value_9'] ?></textarea>
                        </div>
                    <?php endif; ?>
                    <?php if ($settingsTranslate['value_10']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_10']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_10']['field_title'] ? $settingsTranslate['value_10']['field_title'] : "value_10" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_10']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_10']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_10'") ?>
                                    name="<?= $table ?>[envalue_10]"><?= $columnsEN['value_10'] ?></textarea>
                        </div>
                    <?php endif; ?>

                    <?php if ($settingsTranslate['value_11']['on_off']): ?>
                        <div class="row <?= $settingsTranslate['value_11']['on_off'] ? "" : "none" ?>">
                            <div class='clearfix'></div>
                            <div class='pre_input'><?= $settingsTranslate['value_11']['field_title'] ? $settingsTranslate['value_11']['field_title'] : "value_11" ?>
                                EN
                            </div>
                            <textarea <?= ($settingsTranslate['value_11']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_11']['field_style'] . "'" : "data-ckeditor id='" . $table . "_envalue_11'") ?>
                                    name="<?= $table ?>[envalue_11]"><?= $columnsEN['value_11'] ?></textarea>
                        </div>
                    <?php endif; ?>
                </div>
                <?php /**
                 *****END*****
                 */ ?>

            </section>
            <a href="#" class="show_meta || primary button || fl">Мета Теги для Продвижения</a>
            <section class="meta_tags">
                <div class="underlined h2">Мета Теги</div>
                <div class="row">
                    <div class="col_6">
                        <?php if ($settings['url']['on_off']): ?>
                            <div class="row">
                                <div class="pre_input" data-url-start="<?= $columns['url'] ?>"
                                     data-first-entrance="<?= $url['first-entrance'] ?>"><?= $settings['url']['field_title'] ? $settings['url']['field_title'] : "META URL" ?>
                                    <div class="input_count"></div>
                                </div>
                                <input type="text" name="<?= $table ?>[url]"
                                       class="ml_meta || input || to_count <?= $settings['url']['field_style'] ? $settings['url']['field_style'] : "" ?>"
                                       id="url" value='<?= $columns['url'] ?>'>
                            </div>
                        <?php endif; ?>
                        <div langSections="ua">
                            <?php if ($settingsTranslate['title']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input"><?= $settingsTranslate['title']['field_title'] ? $settingsTranslate['title']['field_title'] : "META ЗАГОЛОВОК " ?>
                                        UA
                                        <div class="input_count"></div>
                                    </div>
                                    <input type="text" name="<?= $table ?>[uatitle]"
                                           class="ml_meta || input || to_count <?= $settingsTranslate['title']['field_style'] ? $settingsTranslate['title']['field_style'] : "" ?>"
                                           value='<?= $columnsUA['title'] ?>'>
                                </div>
                            <?php endif; ?>
                            <?php if ($settingsTranslate['keywords']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input"><?= $settingsTranslate['keywords']['field_title'] ? $settingsTranslate['keywords']['field_title'] : "META КЛЮЧЕВЫЕ СЛОВА " ?>
                                        UA
                                        <div class="input_count"></div>
                                    </div>
                                    <input type="text" name="<?= $table ?>[uakeywords]"
                                           class="input || to_count <?= $settingsTranslate['keywords']['field_style'] ? $settingsTranslate['keywords']['field_style'] : "" ?>"
                                           value='<?= $columnsUA['keywords'] ?>'>
                                </div>
                            <?php endif; ?>
                            <?php if ($settingsTranslate['description']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input "><?= $settingsTranslate['description']['field_title'] ? $settingsTranslate['description']['field_title'] : "META ОПИСАНИЕ " ?>
                                        UA
                                        <div class="input_count"></div>
                                    </div>
                                    <textarea name="<?= $table ?>[uadescription]"
                                              class="ml_meta || input || to_count <?= $settingsTranslate['description']['field_style'] ? $settingsTranslate['description']['field_style'] : "" ?>"><?= $columnsUA['description'] ?></textarea>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div langSections="ru" style="display: none;">
                            <?php if ($settingsTranslate['title']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input"><?= $settingsTranslate['title']['field_title'] ? $settingsTranslate['title']['field_title'] : "META ЗАГОЛОВОК " ?>
                                        RU
                                        <div class="input_count"></div>
                                    </div>
                                    <input type="text" name="<?= $table ?>[rutitle]"
                                           class="ml_meta || input || to_count <?= $settingsTranslate['title']['field_style'] ? $settingsTranslate['title']['field_style'] : "" ?>"
                                           value='<?= $columnsRU['title'] ?>'>
                                </div>
                            <?php endif; ?>
                            <?php if ($settingsTranslate['keywords']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input"><?= $settingsTranslate['keywords']['field_title'] ? $settingsTranslate['keywords']['field_title'] : "META КЛЮЧЕВЫЕ СЛОВА " ?>
                                        RU
                                        <div class="input_count"></div>
                                    </div>
                                    <input type="text" name="<?= $table ?>[rukeywords]"
                                           class="input || to_count <?= $settingsTranslate['keywords']['field_style'] ? $settingsTranslate['keywords']['field_style'] : "" ?>"
                                           value='<?= $columnsRU['keywords'] ?>'>
                                </div>
                            <?php endif; ?>
                            <?php if ($settingsTranslate['description']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input "><?= $settingsTranslate['description']['field_title'] ? $settingsTranslate['description']['field_title'] : "META ОПИСАНИЕ " ?>
                                        RU
                                        <div class="input_count"></div>
                                    </div>
                                    <textarea name="<?= $table ?>[rudescription]"
                                              class="ml_meta || input || to_count <?= $settingsTranslate['description']['field_style'] ? $settingsTranslate['description']['field_style'] : "" ?>"><?= $columnsRU['description'] ?></textarea>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div langSections="en" style="display: none;">
                            <?php if ($settingsTranslate['title']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input"><?= $settingsTranslate['title']['field_title'] ? $settingsTranslate['title']['field_title'] : "META ЗАГОЛОВОК " ?>
                                        EN
                                        <div class="input_count"></div>
                                    </div>
                                    <input type="text" name="<?= $table ?>[entitle]"
                                           class="ml_meta || input || to_count <?= $settingsTranslate['title']['field_style'] ? $settingsTranslate['title']['field_style'] : "" ?>"
                                           value='<?= $columnsEN['title'] ?>'>
                                </div>
                            <?php endif; ?>
                            <?php if ($settingsTranslate['keywords']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input"><?= $settingsTranslate['keywords']['field_title'] ? $settingsTranslate['keywords']['field_title'] : "META КЛЮЧЕВЫЕ СЛОВА " ?>
                                        EN
                                        <div class="input_count"></div>
                                    </div>
                                    <input type="text" name="<?= $table ?>[enkeywords]"
                                           class="input || to_count <?= $settingsTranslate['keywords']['field_style'] ? $settingsTranslate['keywords']['field_style'] : "" ?>"
                                           value='<?= $columnsEN['keywords'] ?>'>
                                </div>
                            <?php endif; ?>
                            <?php if ($settingsTranslate['description']['on_off']): ?>
                                <div class="row">
                                    <div class="pre_input "><?= $settingsTranslate['description']['field_title'] ? $settingsTranslate['description']['field_title'] : "META ОПИСАНИЕ " ?>
                                        EN
                                        <div class="input_count"></div>
                                    </div>
                                    <textarea name="<?= $table ?>[endescription]"
                                              class="ml_meta || input || to_count <?= $settingsTranslate['description']['field_style'] ? $settingsTranslate['description']['field_style'] : "" ?>"><?= $columnsEN['description'] ?></textarea>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col_6" style="margin-top: 3rem;">
                        <p class="google_title">
                            <a href="/<?= $url['url'] ?>">
                                <span class="ml_title"
                                      data-input-name="<?= $table ?>[title]"><?= $columnsRU['title'] ?>
                                </span>
                                | <?= SITE_NAME ? SITE_NAME : 'САЙТ'; ?>
                            </a>
                        </p>
                        <p class="google_url"><?= $_SERVER['HTTP_HOST'] ?>/
                            <span data-input-name="<?= $table ?>[url]"><?= $url['url'] ?></span>
                        </p>
                        <p class="google_description" data-input-name="<?= $table ?>[description]">
                            <?= $columnsRU['description'] ?>
                        </p>
                    </div>
                </div>
            </section>
            <button class="button || fr || save_button">Сохранить</button>
            <?php if (isset($_GET['id']) && $_GET['id'] != ''): ?>
                <!--<a href="/<? /*= ($url['url'] === '{*}') ? '' : $url['url'] */ ?>" target="_blank"
                   class="button || fr || preview_button">просмотр</a>-->
            <?php else: ?>
                <input type="submit" name="save_close" value="Сохранить и закрыть"
                       class="button || fr || preview_button">
            <?php endif; ?>
        </form>
    </div>
</div>