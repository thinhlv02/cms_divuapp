<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Tin tức</h3></div>
    <div class="title_right">
        <div class="col-md-9 col-sm-9 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('news/add')?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('news') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>

<?php $this->load->view($view) ?>


<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>