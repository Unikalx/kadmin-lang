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
            <input type="hidden" value="<?= $columns['id'] ?>" name="<?= $table ?>[id]">
            <section>
                <span class="h1"><?= $_GET['id'] ? 'редактирование' : 'добавление'; ?> новости
            </span>
                <div class="row">
                    <?php if ($settings['name']['on_off']): ?>
                        <div class="col_6">
                            <div class="pre_input"><?= $settings['name']['field_title'] ? $settings['name']['field_title'] : "Название Новости" ?></div>
                            <input type="text" name="<?= $table ?>[name]"
                                   class="input <?= $settings['name']['field_style'] ? $settings['name']['field_style'] : "" ?>"
                                   id="name" value="<?= $columns['name'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['date']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['date']['field_title'] ? $settings['date']['field_title'] : "Дата новости" ?></div>
                            <input type='text' name='<?= $table ?>[date]'
                                   class='input || datepicker <?= $settings['date']['field_style'] ? $settings['date']['field_style'] : "" ?>'
                                   value="<?= $columns['date'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
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
                <div class="row">
                    <?php if ($settings['thumbnail']['on_off']): ?>
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="thumbnail" data-<?= $table . '_thumbnail' ?>
                                 class='pre_input'
                                 data-image-url="../pictures/<?= $table ?>/<?= $columns['thumbnail'] ?>"><?= $settings['thumbnail']['field_title'] ? $settings['thumbnail']['field_title'] : "thumbnail" ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use
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
                                <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use
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
                <?php if ($settings['value_1']['on_off']): ?>
                    <div class="row">
                        <div class='clearfix'></div>
                        <div class='pre_input'><?= $settings['value_1']['field_title'] ? $settings['value_1']['field_title'] : "Основной текст" ?></div>
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
                <?php if ($settings['value_3']['on_off']): ?>
                    <div class="row">
                        <div class='clearfix'></div>
                        <div class='pre_input'><?= $settings['value_3']['field_title'] ? $settings['value_3']['field_title'] : "value_3" ?></div>
                        <textarea <?= ($settings['value_3']['field_style'] != 'ckeditor' ? "class='" . $settings['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_value_3'") ?>
                                name="<?= $table ?>[value_3]"><?= $columns['value_3'] ?></textarea>
                    </div>
                <?php endif; ?>
                <?php if ($settings['value_4']['on_off']): ?>
                    <div class="row <?= $settings['value_4']['on_off'] ? "" : "none" ?>">
                        <div class='clearfix'></div>
                        <div class='pre_input'><?= $settings['value_4']['field_title'] ? $settings['value_4']['field_title'] : "value_4" ?></div>
                        <textarea <?= ($settings['value_4']['field_style'] != 'ckeditor' ? "class='" . $settings['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_value_4'") ?>
                                name="<?= $table ?>[value_4]"><?= $columns['value_4'] ?></textarea>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <?php if ($settings['field_1']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_1']['field_title'] ? $settings['field_1']['field_title'] : "field_1" ?></div>
                            <input type='text' name='<?= $table ?>[field_1]'
                                   class='input <?= $settings['field_1']['field_style'] ? $settings['field_1']['field_style'] : "" ?>'
                                   value="<?= $columns['field_1'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_3']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_3']['field_title'] ? $settings['field_3']['field_title'] : "field_1" ?></div>
                            <input type='text' name='<?= $table ?>[field_3]'
                                   class='input <?= $settings['field_3']['field_style'] ? $settings['field_3']['field_style'] : "" ?>'
                                   value="<?= $columns['field_3'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['field_2']['on_off']): ?>
                        <div class="col_6">
                            <div class='pre_input'><?= $settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2" ?></div>
                            <input type='text' name='<?= $table ?>[field_2]'
                                   class='input <?= $settings['field_2']['field_style'] ? $settings['field_2']['field_style'] : "" ?>'
                                   value="<?= $columns['field_2'] ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['field_4']['on_off']): ?>
                        <div class="col_6">
                            <!-- field_4 -->
                            <div class='pre_input'><?= $settings['field_4']['field_title'] ? $settings['field_4']['field_title'] : "field_4" ?></div>
                            <input type='text' name='<?= $table ?>[field_4]'
                                   class='input <?= $settings['field_4']['field_style'] ? $settings['field_4']['field_style'] : "" ?>'
                                   value="<?= $columns['field_4'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if ($settings['image1']['on_off']): ?>
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="image1" data-<?= $table . '_image1' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['image1'] ?>"><?= $settings['image1']['field_title'] ? $settings['field_4']['field_title'] : "image1"; ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use
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
                        <div class="col_6 upload_file">
                            <div data-table="<?= $table ?>" data-field="image2" data-<?= $table . '_image2' ?>
                                 class='pre_input'
                                 data-image-url="/pictures/<?= $table ?>/<?= $columns['image2'] ?>"><?= $settings['image2']['field_title'] ? $settings['field_4']['field_title'] : "image2"; ?>
                                <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use
                                                xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                                <span title='Показать текущую картинку' class='watch_thumbnail'><svg class='icon'><use
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
                        <div class="row">
                            <div class="col_6">
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Name" ?>
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
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Name" ?>
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
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Name" ?>
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
<!--                <a href="/--><?//= $url['url'] ?><!--" target="_blank" class="button || fr || preview_button">просмотр</a>-->
            <?php else: ?>
                <input type="submit" name="save_close" value="Сохранить и закрыть"
                       class="button || fr || preview_button">
            <?php endif; ?>

        </form>
    </div>
</div>