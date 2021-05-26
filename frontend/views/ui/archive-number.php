<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 hidden-xs">
        <table id="align-circles" class="compare-table" data-toggle="table" data-sort-name="date" data-sort-order="desc" data-height="860" data-id="results-table" data-pagination="true" data-page-size="100">
            <thead>
            <tr>
                <th data-field="date"
                    data-align="center">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Date');?>
                </th>
                <th data-field="addNumbers"
                    data-align="center">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Numbers');?>
                </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span date="<?=strtotime(str_replace('/', '-', $currentResult['data']));?>">
                            <?= Helper::formatResultsData($currentResult['data']); ?>
                        </span>
                    </td>
                    <td order="<?=$currentResult->mainNumbers;?>">
                        <? if($currentResult->mainNumbers != ''){ ?>
                            <?
                            $winningNumbers = explode(',', $currentResult->mainNumbers);
                            if(isset($winningNumbers[3])){ ?>
                                <div class="inline-numbers">
                                    <?php foreach (explode(',', $currentResult->mainNumbers) as $value) {
                                        if(is_numeric($value)){
                                            ?>
                                            <span class="main-lottery-number"><?=$value;?></span>
                                        <? }} ?>
                                    <? if($currentResult->addNumbers != ''): ?>
                                        <?
                                        foreach (explode(',', $currentResult->addNumbers) as $value) {
                                            if(is_numeric($value)){
                                                ?>
                                                <span class="secondary-lottery-number"><?=$value;?></span>
                                            <? }} ?>
                                    <? endif;?>
                                    <? if($currentResult['bonus_numbers'] != ''): ?>
                                        <?
                                        foreach (explode(',', $currentResult['bonus_numbers']) as $value) {
                                            if(is_numeric($value)){
                                                ?>
                                                <span class="bonus-lottery-number"><?=$value;?></span>
                                            <? }} ?>
                                    <? endif;?>
                                </div>
                                <?
                            }
                            else
                            {
                                echo $currentResult->mainNumbers;
                            }
                            ?>

                            <?
                        }?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    </div>
</div>
<div class="row up-down-3-results">
    <div class="col-sm-6 no-padding-mobile">
        <h3 class="h2"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_previous'); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_results'); ?></h3>
        <div>
            <?php if(isset($resultSiblings['before']) && !empty($resultSiblings['before'])) {
            foreach ($resultSiblings['before'] as $result) :
                ?>
                <p class="lotto-numbers-date"><?= Helper::getDifferenceDateFromNowTagged(
                        $result['data'],
                        Yii::t(SourceMessage::CATEGORY_GENERAL,'siblingsDatesOnStatisticsPage'),
                        array(
                            '[lottery_name]' => Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name),
                            '[timer_name]' => empty($result['timerName']) ? '' : ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL,$result['timerName'])
                        ),
                        true,
                        Helper::isInHalfYearPeriodDate($result) ? LotteryResultLink::generateLinkByDate([
                            'language' => $page['iso'],
                            'prefix' => $page['url'],
                            'lotteryLink' => $page['lottery_link'],
                            'date' => $result['data'],
                            'timerName' => $result['timerName']
                        ]) : null
                    )['text']; ?></p>
                <? if($result->mainNumbers != ''){ ?>
                    <?
                    $winningNumbers = explode(',', $result->mainNumbers);
                    if(isset($winningNumbers[3])){ ?>
                        <div class="inline-numbers">
                            <?php foreach (explode(',', $result->mainNumbers) as $value) {
                                if(is_numeric($value)){
                                    ?>
                                    <span class="main-lottery-number"><?=$value;?></span>
                                <? }} ?>
                            <? if($result->addNumbers != ''): ?>
                                <?
                                foreach (explode(',', $result->addNumbers) as $value) {
                                    if(is_numeric($value)){
                                        ?>
                                        <span class="secondary-lottery-number"><?=$value;?></span>
                                    <? }} ?>
                            <? endif;?>
                            <? if($result['bonus_numbers'] != ''): ?>
                                <?
                                foreach (explode(',', $result['bonus_numbers']) as $value) {
                                    if(is_numeric($value)){
                                        ?>
                                        <span class="bonus-lottery-number"><?=$value;?></span>
                                    <? }} ?>
                            <? endif;?>
                        </div>
                        <?
                    }
                    else
                    {
                        echo $result->mainNumbers;
                    }
                    ?>

                    <?
                }?>
            <?php endforeach;
            } else {
                ?>
                <div><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'No results'); ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="mobile-divider hidden-sm hidden-md hidden-lg"></div>
    <div class="col-sm-6 no-padding-mobile">
        <h3 class="h2"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_next'); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'stats_results'); ?></h3>
        <div>
            <?php if(isset($resultSiblings['after']) && !empty($resultSiblings['after'])) {
                foreach ($resultSiblings['after'] as $result) :
                    ?>
                    <p class="lotto-numbers-date"><?= Helper::getDifferenceDateFromNowTagged(
                            $result['data'],
                            Yii::t(SourceMessage::CATEGORY_GENERAL,'siblingsDatesOnStatisticsPage'),
                            array(
                                '[lottery_name]' => Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->name),
                                '[timer_name]' => empty($result['timerName']) ? '' : ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL,$result['timerName'])
                            ),

                            true,
                            Helper::isInHalfYearPeriodDate($result) ? LotteryResultLink::generateLinkByDate([
                                'language' => $page['iso'],
                                'prefix' => $page['url'],
                                'lotteryLink' => $page['lottery_link'],
                                'date' => $result['data'],
                                'timerName' => $result['timerName']
                            ]) : null
                        )['text']; ?></p>
                    <? if ($result->mainNumbers != '') { ?>
                        <?
                        $winningNumbers = explode(',', $result->mainNumbers);
                        if (isset($winningNumbers[3])) { ?>
                            <div class="inline-numbers">
                                <?php foreach (explode(',', $result->mainNumbers) as $value) {
                                    if ($value) {
                                        ?>
                                        <span class="main-lottery-number"><?= $value; ?></span>
                                    <? }
                                } ?>
                                <? if ($result->addNumbers != ''): ?>
                                    <?
                                    foreach (explode(',', $result->addNumbers) as $value) {
                                        if ($value) {
                                            ?>
                                            <span class="secondary-lottery-number"><?= $value; ?></span>
                                        <? }
                                    } ?>
                                <? endif; ?>
                                <? if ($result['bonus_numbers'] != ''): ?>
                                    <?
                                    foreach (explode(',', $result['bonus_numbers']) as $value) {
                                        if ($value) {
                                            ?>
                                            <span class="bonus-lottery-number"><?= $value; ?></span>
                                        <? }
                                    } ?>
                                <? endif; ?>
                            </div>
                            <?
                        } else {
                            echo $result->mainNumbers;
                        }
                        ?>

                        <?
                    } ?>
                <?php endforeach;
            } else {
            ?>
            <div class="no-results-statistics"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'No results'); ?></div>
            <?php } ?>
        </div>
    </div>
</div>