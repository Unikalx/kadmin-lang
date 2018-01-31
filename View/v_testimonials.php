<?php
/**
 * @var $action integer
 * @var $table string
 * @var $columns array
 * @var $url string
 */
?>
<div class='wrapper' data-table-name="<?=$table?>" data-up-level-id="<?=$_GET['up_level_id']?>">
    <form data-edit-create action='/kadmin/?c=edit&t=<?=$table ?><?=$_GET['up_level_id'] ? '&up_level_id=' . $_GET['up_level_id'] : '' ?><?=$_GET['up_level_table'] ? '&up_level_table=' . $_GET['up_level_table'] : '' ?>' method='POST' class='clearfix validate_form || with_errors || inst_valid' enctype="multipart/form-data">

        <input type="hidden" value="<?=$table?>" name="table">

        <!-- якщо це редагування то виводиться id -->
        <?php if ($columns['id']['value']): ?>
            <input type="hidden" value="<?=$columns['id']['value']?>" name="<?=$table?>[id]">
        <?php endif; ?>

        <section>

            <!-- виводиться назва таблиці, та дія(створення, редагування) -->
            <span class='h1'><?=defined(strtoupper($table)) && constant(strtoupper($table)) != 1 ? constant(strtoupper($table)):$table?> <?=($action == 2)?'CREATE':'EDIT'?>
                <?php if (!in_array($table, array('faq', 'tags', 'subscribers', 'article_comments', 'article_cat')) ): ?>
                    <a href="/kadmin/?c=settings&t=<?=$table?>"><svg class='icon fr'><use xlink:href='View/img/svgdefs.svg#icon_settings'></use></svg></a>
                <?php endif; ?>
            </span>

            <?php foreach ($columns as $pr): ?>
            <?php if (!(in_array($pr['field_name'], array('url', 'id', 'position', 'password', 'recover_pass'))) && strpos($pr['field_name'], 'title') === false && strpos($pr['field_name'], 'keywords') === false && strpos($pr['field_name'], 'description') === false): ?>

            <?php if ($pr['col']): ?>

            <?php if ($pr['col'] == 2): ?>
</div>
<div class="col_6 <?=($pr['field_type'] == 'file'?'upload_file':'')?>">
    <?php else: ?>
    <div class='row'>
        <div class="col_6 <?=($pr['field_type'] == 'file'?'upload_file':'')?>">
            <?php endif; ?>

            <?php else: ?>
            <div class='row'>
                <?php endif; ?>


                <!--select-->
                <?php if ($pr['field_type'] == 'select'): ?>
                    <div class='pre_input'><?=$pr['field_title']?></div>
                    <select name='<?=$table ?>[<?=$pr['field_name']?>]' class="input" <?=((($pr['field_name'] == 'id_level_2' && !$pr['value']) || ($pr['field_name'] == 'id_level_3' && !$pr['value'])) && $action == 1)?'disabled':''?>>
                        <option value="0" style="display: none;" selected>Select</option>
                        <?php foreach($pr['select'] as $sel): ?>
                            <option <?= $sel['has_level']?'data-has-level':''?> value="<?=$sel['id']?>" <?=($sel['id'] == $pr['selected'])?'selected':''?>><?=$sel['name']?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>

                <!--checkbox-->
                <?php if ($pr['field_type'] == 'checkbox'): ?>
                    <input value="1" name='<?=$table ?>[<?=$pr['field_name']?>]' type='checkbox' value='<?=$pr['value'] ?>' id='<?=$table ?>[<?=$pr['field_name']?>]' <?=$pr['value']?'checked':''?>>
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
                    <input type='text' name='<?=$table ?>[<?=$pr['field_name']?>]' class='input || datetimepicker' value="<?=$pr['value']?>">
                <?php endif; ?>

                <!--varchar-->
                <?php if ($pr['field_type'] == 'text'):?>
                    <div class='pre_input'><?=$pr['field_title']?></div>
                    <input type='text' name='<?=$table ?>[<?=$pr['field_name']?>]' class='input' <?=($pr['field_name'] == 'name')?'id="name"':''?> value="<?=$pr['value']?>">
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
                    <div data-table="<?=$table?>" data-field="<?=$pr['field_name']?>" data-<?=$table . '_' . $pr['field_name']?> class='pre_input' data-image-url="/pictures/<?=$table?>/<?=$pr['value'] ?>"><?=$pr['field_title']?>
                        <span title='Удалить' class='delete_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_trash'></use></svg></span>
                        <span title='Показать изображение' class='watch_thumbnail'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_eye'></use></svg></span>
                    </div>
                    <input data-table="<?=$table?>" data-field="<?=$pr['field_name']?>" type="file" name='<?=$pr['field_name']?>' id='<?=$table . '_' . $pr['field_name']?>' class="upload" data-multiple-caption="{count} files selected">
                    <label class='last_item' for="<?=$table . '_' . $pr['field_name']?>"><span class='file_name'><?=$pr['value']?></span><span class='file_deleted'>Deleted</span><strong><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_upload'></use></svg></svg>Choose a file&hellip;</strong></label>
                <?php if ($pr['value']): ?>
                    <script>$('[data-<?=$table . '_' . $pr['field_name']?>] .delete_thumbnail, [data-<?=$table . '_' . $pr['field_name']?>] .watch_thumbnail').addClass('active')</script>
                <?php endif; ?>
                <?php endif; ?>

                <!--radio-->
                <?php if ($pr['field_type'] == 'radio'): ?>
                    <div class='row'>
                        <input name='<?=$table?>[<?=$pr['field_name']?>]' <?=($pr['value'] == 0)?'checked':''?> type='radio' id='<?=$table?>_<?=$pr['field_name']?>_1' value="0">
                        <label for='<?=$table?>_<?=$pr['field_name']?>_1'>Journal</label>
                        <input name='<?=$table?>[<?=$pr['field_name']?>]' <?=($pr['value'] == 1)?'checked':''?> type='radio' id='<?=$table?>_<?=$pr['field_name']?>_2' value="1">
                        <label for='<?=$table?>_<?=$pr['field_name']?>_2'>Video</label>
                    </div>
                <?php endif; ?>

                <?php if ($pr['col']): ?>
                <?php if ($pr['col'] == 2 || $pr['col'] == -1): ?>
            </div>
        </div>
        <?php endif; ?>
        <?php else: ?>
    </div>
<?php endif; ?>

    <?php endif; ?>
    <?php endforeach; ?>

    </section>

    <?php
    $fg = false;
    $meta = array();
    foreach ($columns as $pr) {
        if (strpos($pr['field_name'], 'title') !== false  || strpos($pr['field_name'], 'keywords') !== false || strpos($pr['field_name'], 'description') !== false || strpos($pr['field_name'], 'url') !== false) {
            $fg = true;
            $meta [] = $pr;
        }
    }
    ?>

    <?php if ($fg): ?>
        <a href='#' class='show_meta || primary button || fl'  <?=($action == 2)?'style="display: none;"':'';?>>Мета Теги для Продвижения</a>
        <section class='meta_tags' <?=($action == 2)?'style="display: block;"':'';?>>
            <div class='underlined h2'>Мета Теги </div>

            <?php $met_cnt = 0;?>
            <?php foreach ($meta as $met): ?>
                <?php $met_cnt++; ?>
                <?php if ($met_cnt % 2 == 1): ?>
                    <div class="row">
                <?php endif; ?>

                <div class='col_6'>
                    <div class='pre_input'><?=$met['field_title'] ?> <div class='input_count'></div></div>
                    <input type='text' name='<?=$table?>[<?=$met['field_name'] ?>]' class='input || to_count'   <?=($met['field_name'] == 'url')?'id="url"':''?> value="<?=$met['value'] ?>">
                </div>

                <?php if ($met_cnt % 2 == 0 || ($met_cnt % 2 == 1 && $met_cnt === count($meta))): ?>
                    </div>
                <?php endif; ?>

            <?php endforeach;?>

        </section>
    <?php endif; ?>
    <button class='button || fr || save_button'>Сохранить</button>
    <?php if ($action == 1): ?>
        <?php $fl = false; foreach ($meta as $mm) if ($mm['field_name'] == 'url') $fl = true; ?>
        <?php if ($fl): ?>
            <a href="<?=$url?>" target="_blank" class='button || fr || preview_button'>просмотр</a>
        <?php endif; ?>
    <?php endif; ?>


    </form>
</div>