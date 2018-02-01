
<section>
    <span class='h1'>Настройки<span class=' fr'></span></span>
    <div class='clearfix'>
        <div class="row">
            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl"><?=(SECTIONS == 1) ? 'Главные секции': SECTIONS; ?></span>
                </div>
                <?php if(!empty($sections)):?>
                <ul>
                    <?php foreach($sections as $section):?>
                         <li><a href="/admin?t=settings&c=change&f=sections&id=<?=$section['id']?>" ><?=$section['name']?></a></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>
            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl"><?php if(SUBSECTIONS == 1){echo 'Подсекции';}else{echo SUBSECTIONS;} ?></span>
                </div>
                <?php if(!empty($subSections)):?>
                    <ul>
                        <?php foreach($subSections as $subSection):?>
                            <li><a href="/admin?t=settings&c=change&f=subsections&id=<?=$subSection['id']?>"><?=$subSection['name']?></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </div>

            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl">Продукты</span>
                </div>
                <ul>
                    <li><a href="/admin?t=settings&c=change&f=product_cats" <?= (PRODUCT_CATS === 0) ? "class='turned_off'" : ""?>><?php if(PRODUCT_CATS == 1 || PRODUCT_CATS == 0){echo 'Категории';}else{echo PRODUCT_CATS;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=products" <?= (PRODUCTS === 0) ? "class='turned_off'" : ""?>><?php if(PRODUCTS == 1 || PRODUCTS == 0){echo 'Продукты';}else{echo PRODUCTS;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=orders" <?= (ORDERS === 0) ? "class='turned_off'" : ""?>><?php if(ORDERS == 1 || ORDERS == 0){echo 'Заказы';}else{echo ORDERS;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=customers" <?= (CUSTOMERS === 0) ? "class='turned_off'" : ""?>><?php if(CUSTOMERS == 1 || CUSTOMERS == 0){echo 'Покупатели';}else{echo CUSTOMERS;} ?></a></li>
                </ul>
            </div>


            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl">Блог</span>
                </div>
                <ul>
                    <li><a href="/admin?t=settings&c=change&f=article_cats" <?= (ARTICLE_CATS === 0) ? "class='turned_off'" : ""?>><?php if(ARTICLE_CATS == 1 || ARTICLE_CATS == 0){echo 'Категории';}else{echo ARTICLE_CATS;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=articles" <?= (ARTICLES === 0) ? "class='turned_off'" : ""?>><?php if(ARTICLES == 1 || ARTICLES == 0){echo 'Статьи';}else{echo ARTICLES;} ?></a></li>
                </ul>
            </div>

            <div class="one_plugin">
                <div class="row">
                    <div class="row">
                        <span class="h2 || fl">Галереи</span>
                    </div>
                    <ul>
                        <li><a href="/admin?t=settings&c=change&f=gallery_cats" <?= (GALLERY_CATS === 0) ? "class='turned_off'" : ""?>><?php if(GALLERY_CATS == 1 || GALLERY_CATS == 0){echo 'Категории';}else{echo GALLERY_CATS;} ?></a></li>

                        <li><a href="/admin?t=settings&c=change&f=galleries" <?= (GALLERIES === 0) ? "class='turned_off'" : ""?>><?php if(GALLERIES == 1 || GALLERIES == 0){echo 'Галереи';}else{echo GALLERIES;} ?></a></li>
                    </ul>
                </div>
            </div>

            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl"><?php if(TESTIMONIALS == 1 || TESTIMONIALS == 0){echo 'Отзывы';}else{echo TESTIMONIALS;} ?></span>
                    <a href="/admin?t=settings&c=change&f=testimonials" class="clear button fr <?= (TESTIMONIALS == 0) ? "turned_off" : ""?>">Edit all</a>
                </div>
            </div>

            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl"><?php if(NEWS == 1 || NEWS == 0){echo 'Новости';}else{echo NEWS;} ?></span>
                    <a href="/admin?t=settings&c=change&f=news" class="clear button fr <?= (NEWS == 0) ? "turned_off" : ""?>">Edit all</a>
                </div>
            </div>

            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl"><?php if(MEDIA == 1 || MEDIA == 0){echo 'Медиа';}else{echo MEDIA;} ?></span>
                    <a href="/admin?t=settings&c=change&f=media" class="clear button fr <?= (MEDIA == 0) ? "turned_off" : ""?>">Edit all</a>
                </div>
            </div>

            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl"><?php if(FAQ == 1 || FAQ == 0){echo 'FAQ';}else{echo FAQ;} ?></span>
                    <a href="/admin?t=settings&c=change&f=faq" class="clear button fr <?= (FAQ == 0) ? "turned_off" : ""?>">Edit all</a>
                </div>

            </div>

            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl">Слайдеры</span>
                </div>
                <ul>
                    <li><a href="/admin?t=settings&c=change&f=slider_1" <?= (SLIDER_1 === 0) ? "class='turned_off'" : ""?>><?php if(SLIDER_1 == 1 || SLIDER_1 == 0){echo 'Слайдер 1';}else{echo SLIDER_1;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=slider_2" <?= (SLIDER_2 === 0) ? "class='turned_off'" : ""?>><?php if(SLIDER_2 == 1 || SLIDER_2 == 0){echo 'Слайдер 2';}else{echo SLIDER_2;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=slider_3" <?= (SLIDER_3 === 0) ? "class='turned_off'" : ""?>><?php if(SLIDER_3 == 1 || SLIDER_3 == 0){echo 'Слайдер 3';}else{echo SLIDER_3;} ?></a></li>
                </ul>
            </div>


            <div class="one_plugin">
                <div class="row">
                    <span class="h2 || fl">Баннеры</span>
                </div>
                <ul>
                    <li><a href="/admin?t=settings&c=change&f=banner_1" <?= (BANNER_1 === 0) ? "class='turned_off'" : ""?>><?php if(BANNER_1 == 1 || BANNER_1 == 0){echo 'Баннер 1';}else{echo BANNER_1;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=banner_2" <?= (BANNER_2 === 0) ? "class='turned_off'" : ""?>><?php if(BANNER_2 == 1 || BANNER_2 == 0){echo 'Баннер 2';}else{echo BANNER_2;} ?></a></li>

                    <li><a href="/admin?t=settings&c=change&f=banner_3" <?= (BANNER_3 === 0) ? "class='turned_off'" : ""?>><?php if(BANNER_3 == 1 || BANNER_3 == 0){echo 'Баннер 3';}else{echo BANNER_3;} ?></a></li>
                </ul>
            </div>

         </div>
    </div>
</section>
