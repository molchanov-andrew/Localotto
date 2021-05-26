<div class="row statistics-container">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?= isset($lotteryHeadBlock) ? $lotteryHeadBlock : ''; ?>
                <?=Yii::$app->pageData->pageContent->content1;?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div class="row links-block">
                    <div class="col-sm-6 col-xs-12 no-padding-mobile">
                        <?php if(isset($buyOnlinePage)) : ?>
                            <a class="long-info-button buy-online-link mobile-single-link" href="<?= $buyOnlinePage['url']; ?>">
                                <span class="mobile-container">
                                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Buy Online'); ?>
                                    <span class="double-arrow double-arrow-transparent"></span>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 col-xs-12 no-padding-mobile">
                        <a class="long-info-button mobile-single-link bb-5-blue" href="<?= $page['lottery_link']; ?>">
                            <span class="mobile-container">
                                <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review'); ?>
                                <span class="double-arrow double-arrow-transparent"></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
                        <div id="statisticsHead" class="statistics-head">
                            <span class="mobile-container clearfix">
                                <h2 class="statistics-title"><?= $statisticsTitle; ?></h2>
                            </span>
                            <div class="mobile-current-numbers hidden-sm hidden-md hidden-lg">
                                <?= $mobileNumbersBlock; ?>
                            </div>
                            <div class="statistics-filter">
                                <?php // Select links by page
                                if(isset($isDateMonthPage) && $isDateMonthPage === true) : ?>
                                    <select id="followLink" class="selectpicker"
                                            <?php if(
                                            (isset($byMonth) && count($daysLinks) > LotteryResults_DB::RESULTS_COUNT_FOR_ENABLE_SEARCH) ||
                                            (isset($byDate) && count($availableLotteryResults) > LotteryResults_DB::RESULTS_COUNT_FOR_ENABLE_SEARCH)
                                            ) { ?>data-live-search="true" <?php } ?>
                                            name="selected_lottery" title="
                                    <?= Helper::replaceContentTags(
                                        ['[lottery_name]' => Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name)],
                                        Yii::t(SourceMessage::CATEGORY_GENERAL,'searchResultsByDate'),
                                        'basic'
                                    ); ?>">
                                        <?php if (isset($byMonth)) : ?>
                                            <?php foreach ($daysLinks as $daysLink) : ?>
                                                <option value="<?= $daysLink['link']; ?>"><?= $daysLink['text']; ?></option>
                                            <?php endforeach; ?>
                                        <?php elseif (isset($byDate)) : ?>
                                            <?foreach ($availableLotteryResults as $result) {
                                                $link = LotteryResultLink::generateLinkByDate([
                                                    'language' => $page['iso'],
                                                    'prefix' => $page['url'],
                                                    'lotteryLink' => $page['lottery_link'],
                                                    'date' => $result['data'],
                                                    'timerName' => $result['timerName']
                                                ]);
                                                if(!empty($link) && ($currentResult['data'] !== $result['data'] || $currentResult['timerName'] !== $result['timerName']))
                                                { ?>
                                                    <option value="<?= $link ?>">
                                                        <?= Helper::formatResultsData($result['data']) . ' ' . (!empty($result['timerName']) ? Yii::t(SourceMessage::CATEGORY_GENERAL,$result['timerName']) : ''); ?>
                                                    </option>
                                                <? }
                                            } ?>
                                            <optgroup label="">
                                                <?php if(!empty($datesOutOfSixMonths)) : ?>
                                                    <option data-post-link="true" value="<?= LotteryResultLink::generateLinkByParams([
                                                        'language' => $page['iso'],
                                                        'prefix' => $page['url'],
                                                        'lotteryLink' => $page['lottery_link'],
                                                        'year' => $page['year']
                                                    ]); ?>"
                                                    ><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Other results for'); ?> <?= $page['year']; ?></option>
                                                <?php endif; ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    </select>
                                <?php // yearly dropdown with search
                                else: ?>
                                    <input type="hidden" id="lotteryId" value="<?= $lottery->id; ?>" name="lottery_id">
                                    <input type="hidden" id="languageIso" value="<?= $page['iso']; ?>" name="language">
                                    <input type="hidden" id="languageId" value="<?= $page['language_id']; ?>" name="language">

                                    <select id="yearResult" class="selectpicker" data-live-search="true" name="selected_lottery" title="
                                        <?= Helper::replaceContentTags(
                                        ['[lottery_name]' => Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name)],
                                        Yii::t(SourceMessage::CATEGORY_GENERAL,'searchResultsByDate'),
                                        'basic'
                                    ); ?>">
                                        <?foreach ($lotteryResults as $result) { ?>
                                            <option
                                                value="<?= $result['data']; ?>"><?=Helper::formatResultsData($result['data']);?></option>
                                        <? } ?>

                                        <optgroup label="">
                                            <?php if(isset($statisticsPages)) : ?>
                                                <?php foreach ($statisticsPages as $statisticsPage): ?>
                                                    <?php if($statisticsPage['year'] != $currentYear) : ?>
                                                        <option data-type="link" value="<?= $statisticsPage['url']; ?>"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Results for '); ?><?= $statisticsPage['year']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </optgroup>
                                    </select>
                                <?php endif; ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
                </div>

                <div id="numbersArchive">
                    <?= isset($numbersBlock) ? $numbersBlock : '' ?>
                </div>

                <?php if(isset($byDate) || isset($byMonth)) : ?>
                    <div id="afterNavigation" class="hidden-xs">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <?php if(isset($byDate)) : ?>
                                    <div id="followCurrentMonth" class="long-info-button">
                                        <span class="long-info-text">
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_check_all')?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_results_for'); ?>
                                            <?= isset($byDate) ? mb_convert_case($page['month'], MB_CASE_TITLE, "UTF-8").' '.$page['year'] : $page['year']; ?>
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <a class="long-info-button" href="<?= LotteryResultLink::generateLinkByParams([
                                        'language' => $page['iso'],
                                        'prefix' => $page['url'],
                                        'lotteryLink' => $page['lottery_link'],
                                        'year' => $page['year']
                                    ]); ?>">
                                        <span class="long-info-text">
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_check_all')?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_results_for'); ?>
                                            <?= isset($byDate) ? mb_convert_case($page['month'], MB_CASE_TITLE, "UTF-8").' '.$page['year'] : $page['year']; ?>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <?php if(!empty($hotNumbersPage)) :?>
                                    <form method="post" class="hot-numbers-link" action="<?= $hotNumbersPage['url']; ?>">
                                        <input type="hidden" name="lottery_id" value="<?= $lottery->id; ?>">
                                        <button type="submit" class="long-info-button">
                                <span class="long-info-text">
                                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_check'); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hot/Cold Numbers'); ?>
                                </span>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <?php if(isset($byDate)) : ?>
            <section class="row other-months-block">
                <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
                    <h4 class="text-center h2"><?= Helper::replaceContentTags(
                            array('[lottery_name]' => Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name))
                            ,Yii::t(SourceMessage::CATEGORY_GENERAL,'otherMonthlyResultsTitle')
                        ); ?>
                    </h4>
                    <div class="divider"></div>
                    <ul class="monthly-list">
                        <?php foreach ($availableDates[$page['year']] as $availableMonth) : ?>
                            <li>
                                <a class="mobile-single-link" href="<?= LotteryResultLink::generateLinkByParams([
                                    'language' => $page['iso'],
                                    'prefix' => $page['url'],
                                    'lotteryLink' => $page['lottery_link'],
                                    'year' => $page['year'],
                                    'month' => $availableMonth
                                ]); ?>"
                                    <?php if(mb_convert_case(Yii::t(SourceMessage::CATEGORY_GENERAL,Helper::getMonthString($availableMonth)),MB_CASE_LOWER, "UTF-8") == $page['month']){ ?>
                                        data-current-month="true"
                                    <?php } ?>
                                   title="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_results_for'); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,Helper::getMonthString($availableMonth)); ?> <?= $page['year']; ?>"
                                >
                                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL,Helper::getMonthString($availableMonth)); ?> <?= $page['year']; ?>
                                    <span class="double-arrow double-arrow-darkblue"></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li>
                            <a class="mobile-single-link" href="<?= LotteryResultLink::generateLinkByParams([
                                'language' => $page['iso'],
                                'prefix' => $page['url'],
                                'lotteryLink' => $page['lottery_link'],
                                'year' => $page['year']
                            ]); ?>"
                               title="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_results_for'); ?> <?= $page['year']; ?>">
                                <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'All results for'); ?> <?= $page['year']; ?>
                                <span class="double-arrow double-arrow-darkblue"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            </section>
        <?php endif; ?>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?=Yii::$app->pageData->pageContent->content2;?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= isset($rightJackpotsBlock) ? $rightJackpotsBlock : ''; ?>
        <?= isset($rightBannerBlock) ? $rightBannerBlock : ''; ?>
    </div>
</div>
<?= isset($bottomJackpotsBlock) ? $bottomJackpotsBlock : ''; // css,js for bottom and right results. ?>
<link rel="stylesheet" href="/public/css/bottom-jackpot.css">
<script src="/public/js/bottom-top-jackpots.js"></script>
<script src="/public/js/numbers-in-year.js"></script>