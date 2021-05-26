<div id="carousel-example-generic" class="carousel slide hidden-xs hidden-sm" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <? for ($z = 1; $z < $count_slider; $z++) {?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$z?>"></li>
        <? } ?>
    </ol>


    <div class="carousel-inner" role="listbox">
        <?
        $k=1;
        foreach ($slider as $slid) {?>
            <div class="item<? if ($k==1) echo " active";?>">
                <a href="<?=$slid['link']?>" target="blank" rel="nofollow"><img src="<?=$slid['src']?>" alt="<?=$slid['alt']?>"/></a>
            </div>
            <?
            $k=0;
        } ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>