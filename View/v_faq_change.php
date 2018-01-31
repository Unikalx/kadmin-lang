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
            <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">
            <section>
                <span class="h1"><?=$table?> <?=$_GET['id'] ? 'редактирование' : 'добавление';?></span>
                <div class="row">
                    <?php if($settings['date']['on_off']):?>
                        <div class="col_6">
                            <div class='pre_input'><?=$settings['date']['field_title'] ? $settings['date']['field_title'] : "date"?></div>
                            <input type='text' name='<?=$table ?>[date]' class='input || datepicker <?=$settings['date']['field_style'] ? $settings['date']['field_style'] : ""?>' value="<?=$columns['date']?>">
                        </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <?php if($settings['thumbnail']['on_off']):?>
                        <div class="col_6 upload_file">
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
                    <?php if($settings['checkbox']['on_off']):?>
                        <div class="col_6" style="padding-top: 3.5rem;">
                            <input name='<?=$table ?>[checkbox]' type='checkbox' class="checkbox <?=$settings['checkbox']['field_style'];?>" value='<?=$columns['checkbox']?>' id='<?=$table ?>[checkbox]' <?=$columns['checkbox']?'checked':''?>>
                            <label for='<?=$table ?>[checkbox]'><?=$settings['date']['field_title'] ? $settings['date']['field_title'] : "checkbox";?></label>
                        </div>
                    <?php endif;?>
                </div>
                <?php if($settings['value_1']['on_off']):?>
                    <div class="row">
                        <div class='clearfix'></div>
                        <div class='pre_input'><?=$settings['value']['field_title'] ? $settings['value']['field_title'] : "value"?></div>
                        <textarea <?=($settings['value']['field_style'] != 'ckeditor' ? "class='".$settings['value']['field_style']."'" : "data-ckeditor id='".$table."_value'")?> name="<?=$table?>[value]"><?=$columns['value']?></textarea>
                    </div>
                <?php endif;?>
                <div class="row">
                    <?php if($settings['field_1']['on_off']):?>
                        <div class="col_6">
                            <div class='pre_input'><?=$settings['field_1']['field_title'] ? $settings['field_1']['field_title'] : "field_1"?></div>
                            <input type='text' name='<?=$table ?>[field_1]' class='input <?=$settings['field_1']['field_style'] ? $settings['field_1']['field_style'] : ""?>' value="<?=$columns['field_1']?>">
                        </div>
                    <?php endif;?>
                    <?php if($settings['field_2']['on_off']):?>
                        <div class="col_6">
                            <div class='pre_input'><?=$settings['field_2']['field_title'] ? $settings['field_2']['field_title'] : "field_2"?></div>
                            <input type='text' name='<?=$table ?>[field_2]' class='input <?=$settings['field_2']['field_style'] ? $settings['field_2']['field_style'] : ""?>' value="<?=$columns['field_2']?>">
                        </div>
                    <?php endif;?>
                </div>
                <?php /**
                 *****TRANSLATE*****
                 */ ?>
                <hr/>
                <div class="button_lang col_12">
                    <a href="#" button="ua" class="button active_button" onclick="return false;">Укр</a>
                    <!--                        <a href="#" button="ru" class="button" onclick="return false;">Рус</a>-->
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
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Имя" ?>
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
                <!--<div langSections="ru" style="display: none;">
                        <?php /*if ($settingsTranslate['name']['on_off'] OR !isset($_GET['id'])): */ ?>
                            <div class="row">
                                <div class="col_6">
                                    <div class="pre_input"><? /*= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Имя" */ ?>
                                        RU
                                    </div>
                                    <input type="text" nameInput="ru" name="<? /*= $table */ ?>[runame]"
                                           class="input <? /*= $settingsTranslate['name']['field_style'] ? $settingsTranslate['name']['field_style'] : "" */ ?>"
                                           value='<? /*= $columnsRU['name'] */ ?>'>
                                </div>
                            </div>
                        <?php /*endif; */ ?>
                        <div class="row">
                            <?php /*if ($settingsTranslate['field_1']['on_off']): */ ?>
                                <div class="col_6">
                                    <div class='pre_input'><? /*= $settingsTranslate['field_1']['field_title'] ? $settingsTranslate['field_1']['field_title'] : "field_1" */ ?>
                                        RU
                                    </div>
                                    <input type='text' name='<? /*= $table */ ?>[rufield_1]'
                                           class='input <? /*= $settingsTranslate['field_1']['field_style'] ? $settingsTranslate['field_1']['field_style'] : "" */ ?>'
                                           value="<? /*= $columnsRU['field_1'] */ ?>">
                                </div>
                            <?php /*endif; */ ?>
                            <?php /*if ($settingsTranslate['field_2']['on_off']): */ ?>
                                <div class="col_6">
                                    <div class='pre_input'><? /*= $settingsTranslate['field_2']['field_title'] ? $settingsTranslate['field_2']['field_title'] : "field_2" */ ?>
                                        RU
                                    </div>
                                    <input type='text' name='<? /*= $table */ ?>[rufield_2]'
                                           class='input <? /*= $settingsTranslate['field_2']['field_style'] ? $settingsTranslate['field_2']['field_style'] : "" */ ?>'
                                           value="<? /*= $columnsRU['field_2'] */ ?>">
                                </div>
                            <?php /*endif; */ ?>
                        </div>
                        <div class="row">
                            <?php /*if ($settingsTranslate['field_3']['on_off']): */ ?>
                                <div class="col_6">
                                    <div class='pre_input'><? /*= $settingsTranslate['field_3']['field_title'] ? $settingsTranslate['field_3']['field_title'] : "field_3" */ ?>
                                        RU
                                    </div>
                                    <input type='text' name='<? /*= $table */ ?>[rufield_3]'
                                           class='input <? /*= $settingsTranslate['field_3']['field_style'] ? $settingsTranslate['field_3']['field_style'] : "" */ ?>'
                                           value="<? /*= $columnsRU['field_3'] */ ?>">
                                </div>
                            <?php /*endif; */ ?>
                            <?php /*if ($settingsTranslate['field_4']['on_off']): */ ?>
                                <div class="col_6">
                                    <div class='pre_input'><? /*= $settingsTranslate['field_4']['field_title'] ? $settingsTranslate['field_4']['field_title'] : "field_4" */ ?>
                                        RU
                                    </div>
                                    <input type='text' name='<? /*= $table */ ?>[rufield_4]'
                                           class='input <? /*= $settingsTranslate['field_4']['field_style'] ? $settingsTranslate['field_4']['field_style'] : "" */ ?>'
                                           value="<? /*= $columnsRU['field_4'] */ ?>">
                                </div>
                            <?php /*endif; */ ?>
                        </div>
                        <?php /*if ($settingsTranslate['value_1']['on_off']): */ ?>
                            <div class="row">
                                <div class='clearfix'></div>
                                <div class='pre_input'><? /*= $settingsTranslate['value_1']['field_title'] ? $settingsTranslate['value_1']['field_title'] : "value_1" */ ?>
                                    RU
                                </div>
                                <textarea <? /*= ($settingsTranslate['value_1']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_1']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_1'") */ ?>
                                        name="<? /*= $table */ ?>[ruvalue_1]"><? /*= $columnsRU['value_1'] */ ?></textarea>
                            </div>
                        <?php /*endif; */ ?>
                        <?php /*if ($settingsTranslate['value_2']['on_off']): */ ?>
                            <div class="row <? /*= $settingsTranslate['value_2']['on_off'] ? "" : "none" */ ?>">
                                <div class='clearfix'></div>
                                <div class='pre_input'><? /*= $settingsTranslate['value_2']['field_title'] ? $settingsTranslate['value_2']['field_title'] : "value_2" */ ?>
                                    RU
                                </div>
                                <textarea <? /*= ($settingsTranslate['value_2']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_2']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_2'") */ ?>
                                        name="<? /*= $table */ ?>[ruvalue_2]"><? /*= $columnsRU['value_2'] */ ?></textarea>
                            </div>
                        <?php /*endif; */ ?>
                        <?php /*if ($settingsTranslate['value_3']['on_off']): */ ?>
                            <div class="row">
                                <div class='clearfix'></div>
                                <div class='pre_input'><? /*= $settingsTranslate['value_3']['field_title'] ? $settingsTranslate['value_3']['field_title'] : "value_3" */ ?>
                                    RU
                                </div>
                                <textarea <? /*= ($settingsTranslate['value_3']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_3']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_3'") */ ?>
                                        name="<? /*= $table */ ?>[ruvalue_3]"><? /*= $columnsRU['value_3'] */ ?></textarea>
                            </div>
                        <?php /*endif; */ ?>
                        <?php /*if ($settingsTranslate['value_4']['on_off']): */ ?>
                            <div class="row <? /*= $settingsTranslate['value_4']['on_off'] ? "" : "none" */ ?>">
                                <div class='clearfix'></div>
                                <div class='pre_input'><? /*= $settingsTranslate['value_4']['field_title'] ? $settingsTranslate['value_4']['field_title'] : "value_4" */ ?>
                                    RU
                                </div>
                                <textarea <? /*= ($settingsTranslate['value_4']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_4']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_4'") */ ?>
                                        name="<? /*= $table */ ?>[ruvalue_4]"><? /*= $columnsRU['value_4'] */ ?></textarea>
                            </div>
                        <?php /*endif; */ ?>

                        <?php /*if ($settingsTranslate['value_5']['on_off']): */ ?>
                            <div class="row <? /*= $settingsTranslate['value_5']['on_off'] ? "" : "none" */ ?>">
                                <div class='clearfix'></div>
                                <div class='pre_input'><? /*= $settingsTranslate['value_5']['field_title'] ? $settingsTranslate['value_5']['field_title'] : "value_5" */ ?>
                                    RU
                                </div>
                                <textarea <? /*= ($settingsTranslate['value_5']['field_style'] != 'ckeditor' ? "class='" . $settingsTranslate['value_5']['field_style'] . "'" : "data-ckeditor id='" . $table . "_ruvalue_5'") */ ?>
                                        name="<? /*= $table */ ?>[ruvalue_5]"><? /*= $columnsRU['value_5'] */ ?></textarea>
                            </div>
                        <?php /*endif; */ ?>
                    </div>-->
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
                                <div class="pre_input"><?= $settingsTranslate['name']['field_title'] ? $settingsTranslate['name']['field_title'] : "Имя" ?>
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
            <button class="button || fr || save_button">Сохранить</button>
            <?php if(!isset($_GET['id']) && $_GET['id']==''):?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>
        </form>
    </div>
</div>