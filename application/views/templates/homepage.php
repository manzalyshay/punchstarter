<!-- Created By Shay Manzaly -->
<!-- Created By Shay Manzaly -->


<!-- Main content -->


<!-- add echo paginiation too -->

<?php if ($pageination): ?>
    <section class="pageination">
        <?php echo ('') ?>
    </section>
<?php endif; ?>


<main class="main-area">

    <div class="centered">
        <!-- Sidebar -->
        <div class="span2 sidebar">
            <h2 class="navbartitle">RECENT</h2>
            <?php echo anchor($projects_list_link, '+ Projects Archive'); ?>
            <?php $projects = array_slice(get_recent($projects), 0, 4); ?>
            <?php echo project_links($projects); ?>
        </div>
        <section class="span9 cards-homepage">
            <?php if(count($projects)): foreach ($projects as $project): ?>
                <project class="card">
                    <!--            <a href="#">-->
                    <figure class="thumbnail">
                        <img src="<?php echo $project->posterurl; ?>">
                    </figure>
                    <div class="card-content">
                        <h2><?php echo $project->title; ?></h2>

                        <?php echo get_excerpt($project); ?><hr>
                    </div>
                    <!--            </a>-->
                </project>
            <?php endforeach; endif; ?>

        </section>




    </div>
</main>