<?php
/**
 * @var $columns array()
 * @vat $table string
 * @var $subsections array()
 * */
?>
<?php $cat = ($_GET['cat']!='') ? '&cat='.$_GET['cat'] : "";?>
<section data-sfield-name="" data-sfield-value="" data-table-has-url="1" data-up-level-id="<?=$_GET['sect']?>" data-table-name="<?=$table?>">
    <div class="underlined h2">
        <span data-showed-table-name=""><?= constant(strtoupper($table))==1 ? strtoupper($table) : constant(strtoupper($table));?></span>
        <div class="per_page">
            <span>Отображать на странице по: </span>
            <a href="#" data-item-val="20" <?php if(!$_COOKIE['items_count'] || $_COOKIE['items_count']==20){?>class="active"<?php }?>>20</a>
            <a href="#" data-item-val="40" <?php if( $_COOKIE['items_count']==40){?>class="active"<?php }?>>40</a>
            <a href="#" data-item-val="60" <?php if( $_COOKIE['items_count']==60){?>class="active"<?php }?>>60</a>
            <a href="#" data-item-val="80" <?php if( $_COOKIE['items_count']==80){?>class="active"<?php }?>>80</a>
            <a href="#" data-item-val="999999" <?php if( $_COOKIE['items_count'] > 80){?>class="active"<?php }?>>Все</a>
        </div>
    </div>

    <div class="row">
        <div class="row || col_9">
            <div class="col_8">
                <a class="button || outline" data-delete-fields="">Удалить выбранное</a>
				<a class="button || outline" href="/kadmin/?t=<?=$table?>&c=change<?=$cat?>">Добавить новое</a>
            </div>
        </div>
        <div class="row || col_3" style="float: right">
            <?php if (count ($product_cats) ) : ?>
                <select class="input ||  ml_filter">
                    <option value="">Все категории</option>
                    <?php foreach($product_cats as $product_cat):?>
                        <option value="<?=$product_cat['id']?>" <?=($_GET['cat']==$product_cat['id']) ? "selected" : ""?>><?=$product_cat['name']?></option>
                    <?php endforeach;?>
                </select>
            <?php endif;?>
        </div>
    </div>

    <!-- Якщо в таблиці є "positon"-->
    <table class="table || checkbox_table" data-table-name="<?=$table?>"
           data-first-position="<?=$subsections[0]['position']?>">
        <thead>
        <tr>
            <td class="tc" width="40">
                <div class="row">
                    <input name="check_all" type="checkbox" id="check_all">
                    <label for="check_all"></label>
                </div>
            </td>

            <td class="tc" width="65" data-field-name="id">
                id
                <a href="/kadmin/?t=<?=$table?>&c=select&sort=<?=$_GET['sort']=='id'?'-':'';?>id" title="Sort items" class="sort"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="View/img/svgdefs.svg#<?php if($_GET['sort']=='-id'){echo 'icon_chevron_up';}elseif($_GET['sort']=='id' ){echo 'icon_chevron_down';}else{echo 'icon_sort';};?>"></use></svg></a>
            </td>
            <td class="tc" width="" data-field-name="name">
                Название продукта
                <a href="/kadmin/?t=<?=$table?>&c=select&sort=<?=$_GET['sort']=='name'?'-':'';?>name" title="Sort items" class="sort"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="View/img/svgdefs.svg#<?php if($_GET['sort']=='-name'){echo 'icon_chevron_up';}elseif($_GET['sort']=='name' ){echo 'icon_chevron_down';}else{echo 'icon_sort';};?>"></use></svg></a>
            </td>
            <td class="tc" width="" data-field-name="url" style="display: none;">
                Url
                <a href="/kadmin/?t=<?=$table?>&c=select&sort=<?=$_GET['sort']=='url'?'-':'';?>url" title="Sort items" class="sort"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="View/img/svgdefs.svg#<?php if($_GET['sort']=='-url'){echo 'icon_chevron_up';}elseif($_GET['sort']=='url' ){echo 'icon_chevron_down';}else{echo 'icon_sort';};?>"></use></svg></a>
            </td>
            <td class="tc" width="">
                Категория
            </td>
            <td class="tc" width="130">РЕДАКТОР</td>
            <td class="tc" width="110" data-field-name="landing">
                ПОЗИЦИЯ
                <a href="/kadmin/?t=<?=$table?>&c=select&sort=<?=$_GET['sort']=='position'?'-':'';?>position" title="Sort items" class="sort"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="View/img/svgdefs.svg#<?php if($_GET['sort']=='-position'){echo 'icon_chevron_up';}elseif($_GET['sort']=='position' ){echo 'icon_chevron_down';}else{echo 'icon_sort';};?>"></use></svg></a>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php $i=0; foreach($products as $product):?>
            <tr id="tr<?=++$i;?>" data-field-id="<?=$product['id']?>">
                <td class="tc" width="40">
                    <div class="row">
                        <input name="check<?=$i;?>" type="checkbox" id="check<?=$i;?>" data-table-checkbox="<?=$table?>">
                        <label for="check<?=$i;?>"></label>
                    </div>
                </td>

                <td class="tc"><?=$product['id']?></td>
                <td class="tc"><?=$product['name']?></td>
                <td class="tc" style="display: none;"><a href="#" onclick="return false;">/<?=$product['url']?></a></td>
                <td class="tc" width="">
                    <?=$product['catName']?>
                </td>
                <td class="tc">
                    <a href="/kadmin/?t=<?=$table?>&c=change&id=<?=$product['id']?>" class="link_icon">
                        <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="View/img/svgdefs.svg#icon_tune"></use></svg>
                    </a>
                </td>
                <td class='tc' width="100"><a href='' class='<?= ($_GET['sort'] == "position") ? "replace" : "disabled_replace";?> || link_icon'><svg class='icon'><use xlink:href='View/img/svgdefs.svg#icon_replace'></use></svg></a></td>

            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <!--пігінація-->
    <?php if($pagination['count_pages'] > 1):?>
        <?php if($_GET['sort']!='') $sort = "&sort=".$_GET['sort']; else $sort='';?>
        <div class='pagination'>
            <?php if($pagination['page'] > 1):?>
                <a class='pagi' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=$pagination['page']-1?>'>
                    <svg class='icon'>
                        <use xlink:href='View/img/svgdefs.svg#icon_chevron_left'></use>
                    </svg>
                </a>
            <?php endif;?>

            <?php for($i=1; $i<=$pagination['count_pages']; $i++):?>
                <?php if($i == 1 && ($pagination['page'] - 3) > 1):?>
                    <a class='pagi' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=1?>'>1</a>
                    <?php $i = $pagination['page'] - 3;?>
                    <a class='pagi' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=$i?>'>...</a>
                <?php elseif($i == ($pagination['page'] + 3) && $i != $pagination['count_pages']):?>
                    <a class='pagi' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=$i?>'>...</a>
                    <a class='pagi' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=$pagination['count_pages']?>'><?=$pagination['count_pages']?></a>
                    <?php $i = $pagination['count_pages'];?>
                <?php else: ?>
                    <a class='pagi || <?= ($pagination['page'] == $i) ? "active" : ""?>' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=$i?>'><?=$i?></a>
                <?php endif?>
            <?php endfor?>
            <?php if(!($pagination['page'] >= $pagination['count_pages'])):?>
                <a class='pagi' href='/kadmin/?t=<?=$table?>&c=select<?=$sort?><?=$cat?>&page=<?=$pagination['page']+1?>'>
                    <svg class='icon'>
                        <use xlink:href='View/img/svgdefs.svg#icon_chevron_right'></use>
                    </svg>
                </a>
            <?php endif;?>
        </div>
    <?php endif?>


</section>