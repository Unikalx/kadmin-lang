<?php
/**
 * @var $table string
 * @var $columns array
 * @var $url array
 */
?>
<div class="wrapper">
    <div class="wrapper">
       <section>
        <!-- виводиться назва таблиці, та дія (створення, редагування) -->
            <span class="h1">ЗАКАЗ<!-- --><?/*=$_GET['id'] ? 'редактирование' : 'добавление';*/?>

            </span>
            <div class="row">
                <div class="col_6">
                    <div class="row">
                        <div class="col_11">
                            <p class="h2">Позиция:</p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ID Заказа:</td>
                                        <td><?=$columns[0]['id_order']?></td>
                                    </tr>
                                    <tr>
                                        <td>Дата:</td>
                                        <td><?=$columns[0]['date']?></td>
                                    </tr>
                                    <tr>
                                        <td>Всего:</td>
                                        <td style="color: #BF5959;font-weight: bold;"><?=$columns[0]['total']?> $</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col_6">
                    <div class="row">
                        <div class="col_11">
                            <p class="h2">Покупатель:</p>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Имя:</td>
                                    <td><?=$columns[0]['name']?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?=$columns[0]['email']?></td>
                                </tr>
                                <tr>
                                    <td>Телефон:</td>
                                    <td><?=$columns[0]['phone']?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 4rem;">

                <table class="table || checkbox_table" data-table-name="<?=$table?>" data-table-sort="" data-up-level-id="">
                    <thead>
                        <tr>
                            <td class="tc" width="65">id</td>
                            <td class="tc" width="65">Продукт</td>
                            <td class="tc" width="65">Количество</td>
                            <td class="tc" width="65">Цена</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($columns as $column):?>
                        <tr>
                            <td class="tc"><?=$i++?></td>
                            <td class="tc"><a href="/kadmin/?t=products&c=change&id=<?=$column['id_product']?>"><?=$column['product_name']?></a></td>
                            <td class="tc"><?=$column['count']?></td>
                            <td class="tc"><?=$column['price']?> $</td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
           <a href="/kadmin/?t=<?=$table?>&c=select&page=1"  class="button || fr || preview_button">НАЗАД</a>
            </div>
       </section>
    </div>
</div>