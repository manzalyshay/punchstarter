<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 11:09 AM
 */
$this->load->view('admin_creator/components/page_head'); ?>
<body>
<div class="navbar navbar-static-top navbar-inverse">
    <div class="navbar-inner">
        <a class="brand" href="<?php echo site_url('admin_creator/dashboard');?>"><?php echo $meta_title; ?></a>
        <ul class="nav">
            <li class="active"><a href="<?php echo site_url('admin_creator/dashboard');?>">Dashboard</a></li>
            <li><?php echo anchor('admin_creator/project', 'Projects'); ?></li>
        </ul>
    </div>
</div>

<div class="container">
        <div class="row">

            <!-- main col-->
            <div class="span9">
                <?php $this->load->view($subview);?>

            </div>
            <!-- side bar-->
            <div class="span3">
                <section>
                    <?php echo anchor('admin/user/logout', '<i class= "icon-off"></i> Logout');?>
                </section>

            </div>
        </div>

</div>
<?php $this->load->view('admin_creator/components/page_tail'); ?>
