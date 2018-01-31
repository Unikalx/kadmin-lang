<aside class="<?= ($_COOKIE['menu_status'] == 'active') ? "active" : ""?>">

    <a href='/kadmin' class='logo'><?php include('View/blocks/svg/logo_primary.php'); ?></a>

    <div class='custom_scroll_wrap1'>
        <div class='custom_scroll_bar'></div>
        <nav class='custom_scroll_wrap2'>
            <ul class='custom_scroll'>

                <?php if (constant('SECTIONS')) : ?>
                    <?php if ($_SESSION['authorize']['status'] == 1) : ?>
                    <li data-menu-name="sections">

                        <a href='/kadmin/?t=sections&c=select&page=1'>
                            <svg class='icon || left_icon'><use xlink:href='View/img/svgdefs.svg#icon_category'></use></svg>
                            <span><?php if(SECTIONS == 1){echo 'Секции';}else{echo SECTIONS;} ?></span>
                        </a>
                    </li>
					<?php else: ?>
					<li data-menu-name="sections">

                        <a href='' class='has_submenu'>
                            <svg class='icon || left_icon'><use xlink:href='View/img/svgdefs.svg#icon_category'></use></svg>
                            <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                            <span><?php if(SECTIONS == 1){echo 'Секции';}else{echo SECTIONS;} ?></span>
                        </a>
						<ul>
                                <li class='submenu_head'><?php if(SECTIONS == 1){echo 'Секции';}else{echo SECTIONS;} ?></li>
                                <?php foreach($sections as $section):?>
                                    <li data-menu-up-level="<?=$section['id']?>"><a href='/kadmin/?t=sections&c=change&id=<?=$section['id']?>'><?=$section['name']?></a></li>
                                <?php endforeach;?>
                            </ul>
                    </li>					
					<?php endif ?>
                <?php endif; ?>

                <?php if (constant('SUBSECTIONS')) : ?>
                    <li data-menu-name="subsections">
                        <a href='' class='has_submenu'>
                            <svg class='icon || left_icon'>
                                <use xlink:href='View/img/svgdefs.svg#icon_subcategory'></use>
                            </svg>
                            <svg class='icon || right_icon'>
                                <use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use>
                            </svg>
                            <span><?php if(SUBSECTIONS == 1){echo 'Подсекции';}else{echo SUBSECTIONS;} ?></span>
                        </a>
                        <?php if ($sections_sub != null) : ?>
                            <ul>
                                <li class='submenu_head'><?php if(SUBSECTIONS == 1){echo 'Подсекции';}else{echo SUBSECTIONS;} ?></li>
                                <?php foreach($sections_sub as $subsection):?>
                                    <li data-menu-up-level="<?=$subsection['id']?>"><a href='/kadmin/?t=subsections&c=select&sect=<?=$subsection['id']?>&page=1'><?=$subsection['name']?></a></li>
                                <?php endforeach;?>
                            </ul>
                        <?php endif;?>
                    </li>
                <?php endif; ?>
		
                <?php if (constant('PRODUCTS')) : ?>
                <li><a href='' class='has_submenu'>
                        <svg class='icon || left_icon'><use xlink:href='View/img/svgdefs.svg#icon-location'></use></svg>
                        <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                        <span>Каталог</span>
                    </a>
                    <ul>
                        <li class='submenu_head'><?php if(PRODUCTS == 1){echo 'Products';}else{echo PRODUCT_CATS;} ?></li>

                        <?php if (constant('PRODUCT_CATS')) : ?>
                            <li data-menu-name="product_cats"><a href='/kadmin/?t=product_cats&c=select&page=1'><?php if(PRODUCT_CATS == 1){echo 'Категории';}else{echo PRODUCT_CATS;} ?></a></li>
                        <?php endif;?>

<!--                        --><?php //if (constant('CATEGORIES')) : ?>
<!--                            --><?php //if (count(CATEGORIES)):?>
<!--                                <li data-menu-name="level_2"><a href='' class="has_submenu">--><?php //if(CATEGORIES == 1){echo 'CATEGORIES';}else{echo CATEGORIES;} ?><!--</a>-->
<!--                                    <ul>-->
<!--                                        <div class="custom_scroll_wrap1">-->
<!--                                            <div class="custom_scroll_bar"></div>-->
<!--                                            <div class="custom_scroll_wrap2">-->
<!--                                                <div class="custom_scroll">-->
<!--                                        --><?php //foreach($level_1 as $category):?>
<!--                                            <li data-menu-up-level="--><?//=$category['id']?><!--"><a href="/kadmin/?c=view&v=table&t=level_2&page=1&up_level_t=level_1&up_level_id=--><?//=$category['id']?><!--">--><?//=$category['name']?><!--</a></li>-->
<!--                                        --><?php //endforeach?>
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            --><?php //else:?>
<!--                                <li><a href='/kadmin/?c=view&v=create&t=level_1' class="">--><?php //if(LEVEL_2 == 1){echo 'Subcategory1';}else{echo LEVEL_2;} ?><!--</a></li>-->
<!--                            --><?php //endif?>
<!--                        --><?php //endif;?>


                        <li data-menu-name="products"><a href='/kadmin/?t=products&c=select&page=1'>Продукты</a></li>

                        <?php if (constant('ORDERS')) : ?>
                            <li data-menu-name="orders"><a href='/kadmin/?t=orders&c=select&page=1'><?php if(ORDERS == 1){echo 'Заказы';}else{echo ORDERS;} ?></a></li>
                        <?php endif;?>
                        <?php if (constant('CUSTOMERS')) : ?>
                            <li data-menu-name="customers"><a href='/kadmin/?t=customers&c=select&page=1'><?php if(CUSTOMERS == 1){echo 'Клиенты';}else{echo CUSTOMERS;} ?></a></li>
                        <?php endif;?>
                    </ul>
                </li>
                <?php endif;?>
                <?php if (constant('GALLERIES')) : ?>
                <li>
                    <a href='' class='has_submenu'>
                        <svg class='icon || left_icon'><use xlink:href='View/img/svgdefs.svg#icon_image'></use></svg>
                        <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                        <span><?php if(GALLERIES == 1){echo 'Галереи';}else{echo GALLERIES;} ?></span>
                    </a>
                    <ul>
                        <li class='submenu_head'><?php if(GALLERIES == 1){echo 'Galleries';}else{echo GALLERIES;} ?></li>

                        <?php if (constant('GALLERY_CATS')) : ?>
                            <li data-menu-name="gallery_cats"><a href='/kadmin/?t=gallery_cats&c=select&page=1'><?php if(GALLERY_CATS == 1){echo 'Категории Галерей';}else{echo GALLERY_CATS;} ?></a></li>
                        <?php endif;?>
                        <?php if (constant('GALLERIES')) : ?>
                            <li data-menu-name="galleries"><a href='/kadmin/?t=galleries&c=select&page=1'><?php if(GALLERIES == 1){echo 'Галереи';}else{echo GALLERIES;} ?></a></li>
                        <?php endif?>
                    </ul>
                </li>
                <?php endif;?>
                <?php if (constant('ARTICLES')) : ?>
                <li><a href='' class='has_submenu'>
                        <svg class='icon || left_icon'><use xlink:href='View/img/svgdefs.svg#icon_blog'></use></svg>
                        <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                        <span><?php if(ARTICLES == 1){echo 'Блог';}else{echo ARTICLES;} ?></span>
                    </a>
                    <ul>
                        <li class='submenu_head'><?php if(ARTICLES == 1){echo 'Блог';}else{echo ARTICLES;} ?></li>
                        <?php if (constant('ARTICLE_CATS')) : ?>
                            <li data-menu-name="article_cats"><a href='/kadmin/?t=article_cats&c=select&page=1'><?php if(ARTICLE_CATS == 1){echo 'Категории Блога';}else{echo ARTICLE_CATS;} ?></a></li>
                        <?php endif;?>
                        <?php if (constant('ARTICLE_TAGS')) : ?>
                            <li data-menu-name="article_tags"><a href='/kadmin/?t=article_tags&c=select&page=1'><?php if(ARTICLE_TAGS == 1){echo 'Теги';}else{echo ARTICLE_TAGS;} ?></a></li>
                        <?php endif;?>
                        <?php if (constant('ARTICLE_COMMENTS')) : ?>
                            <li data-menu-name="article_comments"><a href='/kadmin/?t=article_comments&c=select&page=1'>Комментарии</a></li>
                        <?php endif;?>

                        <?php if (constant('ARTICLES')) : ?>
                                    <li data-menu-name="articles"><a href='/kadmin/?t=articles&c=select&page=1' class=""><?php if(ARTICLES == 1){echo 'Статьи Блога';}else{echo ARTICLES;} ?></a>
                        <?php endif?>
                    </ul>
                </li>
                <?php endif;?>
                <? if (NEWS         != 0 ||
                       TESTIMONIALS != 0 ||
                       BANNER_1     != 0 ||
                       SLIDER_1     != 0 ||
                       SUBSCRIBERS  != 0 ||
                       FAQ     		!= 0 ||
                       MEDIA        != 0 ) : ?>
                <li><a href='' class='has_submenu'>
                        <svg class='icon || left_icon'><use xlink:href='View/img/svgdefs.svg#icon_extras'></use></svg>
                        <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                        <span>Дополнительно</span>
                    </a>
                    <ul>
                        <li class='submenu_head'>Дополнительно</li>
                        <?php if (constant('NEWS')):?>
                            <li data-menu-name="news"><a href='/kadmin/?t=news&c=select&page=1'><?php if(NEWS == 1){echo 'Новости';}else{echo NEWS;} ?></a></li>
                        <?php endif;?>
                        <?php if (constant('TESTIMONIALS')):?>
                            <li data-menu-name="testimonials"><a href='/kadmin/?t=testimonials&c=select&page=1'><?php if(TESTIMONIALS == 1){echo 'Отзывы';}else{echo TESTIMONIALS;} ?></a></li>
                        <?php endif;?>
                        <?php if (constant('BANNER_1') || constant('BANNER_2') || constant('BANNER_2')):?>
                            <li><a href='' class='has_submenu'>
                                    <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                                    Баннеры
                                </a>
                                <ul>
                                    <?php if (constant('BANNER_1')):?>
                                        <li data-menu-name="banner_1"><a href="/kadmin/?t=banner_1&c=select&page=1"><?php if(BANNER_1 == 1){echo 'Баннер 1';}else{echo BANNER_1;} ?></a></li>
                                    <?php endif?>
                                    <?php if (constant('BANNER_2')):?>
                                        <li data-menu-name="banner_2"><a href="/kadmin/?t=banner_2&c=select&page=1"><?php if(BANNER_2 == 1){echo 'Баннер 2';}else{echo BANNER_2;} ?></a></li>
                                    <?php endif?>
                                    <?php if (constant('BANNER_3')):?>
                                        <li data-menu-name="banner_3"><a href="/kadmin/?t=banner_3&c=select&page=1"><?php if(BANNER_3 == 1){echo 'Баннер 3';}else{echo BANNER_3;} ?></a></li>
                                    <?php endif?>
                                </ul>
                            </li>
                        <?php endif;?>
                        <?php if (constant('SLIDER_1') || constant('SLIDER_2') || constant('SLIDER_3')):?>
                            <li><a href='' class='has_submenu'>
                                    <svg class='icon || right_icon'><use xlink:href='View/img/svgdefs.svg#icon_chevron_down'></use></svg>
                                    Слайдеры
                                </a>
                                <ul>
                                    <?php if (constant('SLIDER_1')):?>
                                    <li data-menu-name="slider_1"><a href="/kadmin/?t=slider_1&c=select&page=1"><?php if(SLIDER_1 == 1){echo 'Слайдер 1';}else{echo SLIDER_1;} ?></a></li>
                                    <?php endif?>
                                    <?php if (constant('SLIDER_2')):?>
                                        <li data-menu-name="slider_2"><a href="/kadmin/?t=slider_2&c=select&page=1"><?php if(SLIDER_2 == 1){echo 'Слайдер 2';}else{echo SLIDER_2;} ?></a></li>
                                    <?php endif?>
                                    <?php if (constant('SLIDER_3')):?>
                                        <li data-menu-name="slider_3"><a href="/kadmin/?t=slider_3&c=select&page=1"><?php if(SLIDER_3 == 1){echo 'Слайдер 3';}else{echo SLIDER_3;} ?></a></li>
                                    <?php endif?>
                                </ul>
                            </li>
                        <?php endif;?>

                        <?php if (constant('MEDIA')):?>
                            <li data-menu-name="media"><a href='/kadmin/?t=media&c=select&page=1'><?php if(MEDIA == 1){echo 'Медиа';}else{echo MEDIA;} ?></a></li>
                        <?php endif;?>

                        <?php if (constant('FAQ')):?>
                            <li data-menu-name="faq"><a href='/kadmin/?t=faq&c=select&page=1'><?php if(FAQ == 1){echo 'FAQ';}else{echo FAQ;} ?></a></li>
                        <?php endif;?>

                        <?php if (constant('SUBSCRIBERS')):?>
                            <li data-menu-name="subscribers"><a href='/kadmin/?t=subscribers&c=select&page=1'><?php if(SUBSCRIBERS == 1){echo 'Подписчики';}else{echo SUBSCRIBERS;} ?></a></li>
                        <?php endif;?>

                    </ul>
                </li>
                <?php endif;?>
                <?php if ($_SESSION['authorize']['status'] == 1) : ?>
                    <li>
                        <a href="/kadmin/?t=settings&c=select">
                            <svg class='icon || left_icon <?php if($_GET['t']=='settings' || ($_GET['t'] != 'user_settings' && $_GET['c']=='settings')) echo 'active_nav'; ?>'><use xlink:href='View/img/svgdefs.svg#icon_settings'></use></svg>
                            <span class="<?php if($_GET['t']=='settings' || ($_GET['t'] != 'user_settings' && $_GET['c']=='settings')) echo 'active_nav'; ?>">Настройки</span>
                        </a>
                    </li>
                <?php endif?>
                    <li data-menu-name="users">
                        <a href="/kadmin/?t=users&c=select&page=1">
                            <svg class='icon || left_icon '><use xlink:href='View/img/svgdefs.svg#icon_group'></use></svg>
                            <span>Пользователи</span>
                        </a>
                    </li>
            </ul>
        </nav>
    </div>
    <div class='copyright'>
        Copyright 2008-<?=date('Y')?> <b></b>
        <a href='http://korzun.com.ua'>Korzun Studio</a><br/>
		Version: <?=JB_VERSION?>
    </div>
</aside>