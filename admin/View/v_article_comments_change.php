<?php
/**
 * @var $table string
 * @var $url array
 * @var $columns array
 * @var $categories array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" data-up-level-id="<?=$columns['id_sect']?>">
        <form data-edit-create="<?=$table?>" action="" method="POST" class="clearfix " enctype="multipart/form-data">

    <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> комментария к статье

            </span>


        <!-- name -->
                <div class="row">
                    <div class="col_6 ">
                        <div class="pre_input">Имя</div>
                        <input type="text" name="<?=$table?>[name]" class="input" id="name" value="<?=$columns['name']?>">
                    </div>
                    <div class="col_6">
        <!-- article_id -->
                        <div class='pre_input'>Название статьи</div>
                        <select name='<?=$table ?>[article_id]' class="input">
                            <option value="0" style="display: none;" selected>Выбрать</option>
                            <?php foreach($articles as $article): ?>
                                <option value="<?=$article['id']?>" <?=($article['id'] == $columns['article_id'])?'selected':''?>><?=$article['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col_6">
        <!--date-->
                        <div class='pre_input'>Дата</div>
                        <input type='text' name='<?=$table ?>[date]' class='input || datetimepicker' value="<?=$columns['date']?>">
                    </div>
        <!-- checkbox -->
                    <div class="col_6" style="margin-top: 3rem;">
                        <input value="1" name='<?=$table ?>[checkbox]' type='checkbox' id='<?=$table ?>[checkbox]' <?=($columns['checkbox'] == 1)?'checked':''?>>
                        <label for='<?=$table ?>[checkbox]'>Опубликовать</label>
                    </div>
                </div>

        <!-- value -->
                <div class="row">
                    <!--ckeditor-->
                    <div class='clearfix'></div>
                    <div class='pre_input'>Текст комментария</div>
                    <textarea data-ckeditor id="<?=$table?>_value" name="<?=$table?>[value]"><?=$columns['value']?></textarea>
                </div>

        </section>

        <button class="button || fr || save_button">Сохранить</button>

        </form>
    </div>
</div>