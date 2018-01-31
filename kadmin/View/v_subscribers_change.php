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

    <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id']?>" name="<?=$table?>[id]">

        <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$_GET['id'] ? 'редактирование' : 'добавление';?> ПОДПИСЧИКА

            </span>


        <!-- name -->
                <div class="row">
                    <div class="col_6 ">
                        <div class="pre_input">Имя</div>
                        <input type="text" name="<?=$table?>[name]" class="input" id="name" value="<?=$columns['name']?>">
                    </div>
                    <div class="col_6">
        <!-- email -->
                        <div class="pre_input">email</div>
                        <input type="text" name="<?=$table?>[email]" class="input" id="email" value="<?=$columns['email']?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col_6">
        <!-- field_1 -->
                       <div class='pre_input'>Поле №1</div>
                       <input type='text' name='<?=$table ?>[field_1]' class='input' value="<?=$columns['field_1']?>">
                    </div>
                    <div class="col_6">
        <!-- field_3 -->
                        <div class='pre_input'>Поле №3</div>
                        <input type='text' name='<?=$table ?>[field_3]' class='input' value="<?=$columns['field_3']?>">
                     </div>
                </div>
                <div class="row">
                    <div class="col_6">
        <!-- field_2 -->
                        <div class='pre_input'>Поле №2</div>
                        <input type='text' name='<?=$table ?>[field_2]' class='input' value="<?=$columns['field_2']?>">
                    </div>
                    <div class="col_6">
        <!-- field_4 -->
                        <div class='pre_input'>Поле №4</div>
                        <input type='text' name='<?=$table ?>[field_4]' class='input' value="<?=$columns['field_4']?>">
                     </div>
                </div>
        </section>

        <button class="button || fr || save_button">Сохранить</button>

            <?php if(!isset($_GET['id']) && $_GET['id']==''):?>
                <input type="submit" name="save_close" value="Сохранить и закрыть" class="button || fr || preview_button">
            <?php endif;?>

        </form>
    </div>
</div>