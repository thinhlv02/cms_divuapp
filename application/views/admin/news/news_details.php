<section class="news">
    <div class="container">
        <div class="col-sm-12 col-md-8">
            <!--            <div class="img-news col-xs-6 col-sm-6 col-md-6"><img src="-->
            <?php //echo base_url('public/images/news/'.$detail->img)?><!--"></div>-->
            <!--            <br />-->
            <!--            <ol class="breadcrumb">-->
            <!--                <li><a href="--><?php //echo base_url()?><!--">-->
            <?php //echo $this->lang->line('home'); ?><!--</a></li>-->
            <h1 class="font31 mgb15"><?php echo $detail->title ?></h1>
            <small><?php echo date('d/m/y', $detail->created) ?></small>
            <!--            </ol>-->
            <div class="col-sm-12 col-md-4">
                <img class="img-responsive"
                     src="<?php echo base_url('public/images/news/') . $detail->img ?>"
                     height="200px">
            </div>
            <!--            <button type="button" class="btn btn-green-cyan">-->
            <?php //echo date('d/m/y', $detail->created) ?><!--</button>-->
            <div>
                <?php echo $detail->content ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="x_content">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ol class="breadcrumb">
                            <li class="active">Các tin khác
                            </li>
                        </ol>
                        <?php $i = 0;
                        if (isset($news) && count($news) > 0) foreach ($news as $key => $value): $i++; ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <!--        <a href="-->
                                <?php //echo $content->link_webgame ?><!--" target="_blank" class="btn btn-green-cyan">Chơi game</a>-->
                                <h5 class="text-uppercase"><a
                                            href="<?php echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?>"><?php echo $i . '.' . $value->title ?></a>
                                </h5>
                                <!--                                <a href="-->
                                <?php //echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?><!--">-->
                                <?php //echo $value->title ?><!--</a>-->
                                <span style="font-style: italic; color: #666;">Ngày đăng: <?php echo date('d/m/Y', $value->created) ?></span><br/>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <img class="img-responsive"
                                         src="<?php echo base_url('public/images/news/') . $value->img ?>"
                                         height="200px">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div style="margin-top: 10px"><?php echo substr($value->intro, 0, 500); ?></div>
                                </div>
                            </div>
                            <div style="clear: both; border-bottom: 1px solid #3c763d33"></div>
                        <?php endforeach ?>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>