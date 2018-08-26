
<main class="main-area">

    <div class="centered">

                <project class="card">
                    <!--            <a href="#">-->
                    <figure class="thumbnail-project">
                        <img src="<?php echo $project->posterurl; ?>">
                    </figure>
                    <div class="card-content">
                        <h2><?php echo $project->title; ?></h2>

                        <?php echo $project->body; ?><hr>

                        <p class="deadline"><?php echo get_deadline_funded($project) ?></p>
                        <p class="deadline"><?php echo get_backers_pledged($project) ?></p>

                    </div>
                </project>

    </div>
</main>

