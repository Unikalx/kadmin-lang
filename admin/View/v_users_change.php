<?php
/**
 * @var $table string
 * @var $columns array
 * @var $url array
 */
?>
<div class="wrapper">
    <div class="wrapper" data-table-name="<?=$table?>" data-up-level-id="">
        <form data-edit-create="<?=$_GET['c']?>" action="" method="POST" class="clearfix validate_form || with_errors || inst_valid" enctype="multipart/form-data">

    <!-- якщо це редагування то виводиться id -->
        <input type="hidden" value="<?=$columns['id_user']?>" name="<?=$table?>[id_user]">
        <section>

                <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1"><?=$table?> <?=$_GET['id'] ? 'редактирование' : 'добавление';?>

            </span>


            <div class="row">
                <div class="col_6 ">
    <!-- login -->
                    <div class="pre_input">Логин</div>
                    <input type="text" name="<?=$table?>[login]" class="input" id="login" value="<?=$columns['login']?>">
                </div>
                <div class="col_6 ">
    <!-- status -->
                    <div class='pre_input'>Статус</div>
                    <select name='<?=$table?>[status]' class="input">
                        <option value="0" <?=$columns['status']==0?"selected":"";?>>Администратор</option>
                        <? if ($_SESSION['authorize']['status'] == 1){?><option value="1" <?=$columns['status']==1?"selected":"";?>>Супер Администратор</option> <? } ?>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col_6">
                    <a href="#" class="button || fl || hide_pass"  style="<?= isset($_GET['id']) ? "" : "display:none;"?> margin-top: 3rem;">Сменить Пароль</a>
                    <div class="pass_block" <?= !isset($_GET['id']) ? "" : "style='display:none'"?>>
    <!-- password -->
                        <div class="pre_input" >Пароль</div>
                        <input type="password" name="<?=$table?>[password]" class="input" id="password">
                    </div>
                </div>

                <div class="col_6">
    <!-- admin_mail -->
                    <div class="pre_input">Email администратора</div>
                    <input type="text" name="<?=$table?>[admin_mail]" class="input" id="admin_mail" value="<?=$columns['admin_mail']?>">
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