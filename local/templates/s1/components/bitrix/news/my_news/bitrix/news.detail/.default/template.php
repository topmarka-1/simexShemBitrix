<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="section section-gray news-detail anim-fade-in-up">
    <div class="container">
        <div class="news-detail__container">
            <div class="news-detail__head">
                <div class="news-detail__head_text text-content">
                    <h1 class="h2"><?=$arResult['PROPERTIES']['TITLE']['VALUE'] ? $arResult['PROPERTIES']['TITLE']['~VALUE']['TEXT'] : $arResult['NAME'] ?></h1>
                    <?= $arResult['PREVIEW_TEXT'] ?>
                </div>
                <div class="detail_picture">
                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC'] ?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                </div>
            </div>
			<? if ($arResult['DETAIL_TEXT']) : ?>
            <div class="news-detail__content text-content">
                <?= $arResult['DETAIL_TEXT'] ?>
            </div>
			<? endif; ?>
        </div>
		<?
			global $aboutFilter;
			$aboutFilter = ['ID' => 58];
			$APPLICATION->IncludeComponent("bitrix:news.list", "advs", Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"AJAX_MODE" => "N",	// Включить режим AJAX
					"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
					"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
					"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
					"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
					"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
					"CACHE_GROUPS" => "Y",	// Учитывать права доступа
					"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					"CACHE_TYPE" => "A",	// Тип кеширования
					"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
					"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
					"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
					"DISPLAY_DATE" => "Y",	// Выводить дату элемента
					"DISPLAY_NAME" => "Y",	// Выводить название элемента
					"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
					"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
					"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
					"FIELD_CODE" => array(	// Поля
						0 => "",
						1 => "",
					),
					"FILTER_NAME" => "aboutFilter",	// Фильтр
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
					"IBLOCK_ID" => "17",	// Код информационного блока
					"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
					"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
					"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
					"NEWS_COUNT" => "20",	// Количество новостей на странице
					"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
					"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
					"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
					"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
					"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
					"PAGER_TITLE" => "Новости",	// Название категорий
					"PARENT_SECTION" => "",	// ID раздела
					"PARENT_SECTION_CODE" => "",	// Код раздела
					"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
					"PROPERTY_CODE" => array(	// Свойства
						0 => "TITLE",
						1 => "NUMS_TEXT",
						2 => "SUBTITLE",
						3 => "NUMS",
						4 => "ADVS_TITLE",
						5 => "ADVS_TEXT",
						6 => "SECTION_COLOR",
						7 => "",
					),
					"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
					"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
					"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
					"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
					"SET_STATUS_404" => "N",	// Устанавливать статус 404
					"SET_TITLE" => "N",	// Устанавливать заголовок страницы
					"SHOW_404" => "N",	// Показ специальной страницы
					"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
					"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
					"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
					"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
					"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
				),
				false
			);?>
            <!-- <div class="about__advs">
                <div class="heading">
					<h2>Компания «Симэкс-Хим» специализируется
						на контрактном производстве высококачественных масел</h2>
				</div>
                <div class="about__advs_list">
                    <div class="about__advs_item swiper-slide">
                        <div class="about__advs_item_img">
                            <img src="/assets/img/advs_1.png" alt="advs 1">
                        </div>
                        <div class="about__advs_item_title">
                            <h5>Многоэтапный<br>
                                контроль качества</h5>
                        </div>
                        <div class="about__advs_item_text">
                            <p>Отдел технического контроля проводит
                                14-ти этапный контроль качества</p>
                        </div>
                    </div>
                    <div class="about__advs_item swiper-slide">
                        <div class="about__advs_item_img">
                            <img src="/assets/img/advs_2.png" alt="advs 2">
                        </div>
                        <div class="about__advs_item_title">
                            <h5>Экологичность
                                и устойчивое производство</h5>
                        </div>
                        <div class="about__advs_item_text">
                            <p>Энергоэффективность оборудования,
                                переработка отходов и минимизация выбросов</p>
                        </div>
                    </div>
                    <div class="about__advs_item swiper-slide">
                        <div class="about__advs_item_img">
                            <img src="/assets/img/hero-slide.png" alt="advs 3">
                        </div>
                        <div class="about__advs_item_title">
                            <h5>Современные технологии
                                и автоматизация производства</h5>
                        </div>
                        <div class="about__advs_item_text">
                            <p>Точное дозирование присадок и контроль качества
                                на каждом этапе обеспечивают стабильность</p>
                        </div>
                    </div>
                </div>
            </div> -->
    </div>
</section>