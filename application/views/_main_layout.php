<?php $this->load->view('components/page_head');?>





<header class="masthead clear">

<div class="centered">
    <div class="site-branding">
        <h1 class="site-title">
            <?php echo anchor('', strtoupper(config_item('site_name'))) ?>
        </h1>
    </div>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <?php echo get_menu($menu) ?>
            </div>
        </div>

    </div>
</div>
</header>

<body>
<!--<div class="container">-->
<!--    <div class="row">-->
<?php $this->load->view('templates/' . $subview); ?>

<!--    </div>-->
<!--</div>-->
<?php $this->load->view('components/page_tail');?>
