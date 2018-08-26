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

            <section class="cards">
        <?php if(count($projects)): foreach ($projects as $project): ?>
        <project class="card">
<!--            <a href="#">-->
            <figure class="thumbnail">
                <img class="projectview" src="<?php echo $project->posterurl; ?>">
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




