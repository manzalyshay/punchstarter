<!-- ///**
// * Created by IntelliJ IDEA.
// * project: shaym
// * Date: 8/7/18
// * Time: 11:09 AM
// */ -->
<h3><?php echo empty($project->id)? 'Add a new project' : 'Edit project ' . $project->title;?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart(); ?>

<table class="table">

    <tr>
        <td>Title</td>
        <td>
            <?php echo form_input('title', set_value('title', $project->title)); ?>
        </td>

    </tr>
    <tr>
        <td>Category</td>
        <td>
            <?php echo form_dropdown('category',array('design_tech' => 'Design & Tech', 'comics_illustration' => 'Comics & Illustration', 'game' => 'Game', 'food_crafts' => 'Food & Crafts', 'music' => 'Music', 'publishing' => 'Publishing', 'film' => 'Film', 'arts' => 'Arts'), $this->input->post('category') ? $this->input->post('category') : $project->category); ?>
        </td>

    </tr>
    <tr>
        <td>Publish Date</td>
        <td>
            <?php echo form_input('pubdate', set_value('pubdate', $project->pubdate), 'class = "datepicker"'); ?>
        </td>

    </tr>
    <tr>
        <td>Deadline</td>
        <td>
            <?php echo form_input('deadline', set_value('deadline', $project->deadline), 'class = "datepicker"'); ?>
        </td>

    </tr>
    <tr>
        <td>Goal</td>
        <td>
            <?php echo form_input('goal', set_value('goal', $project->goal)); ?>
        </td>

    </tr>
    <tr>
        <td>Poster URL</td>
        <td>
            <?php echo form_input('posterurl', set_value('posterurl',$project->posterurl)); ?>

        </td>

    </tr>
    <tr>
        <td>Slug</td>
        <td>
            <?php echo form_input('slug', set_value('slug',$project->slug)); ?>
        </td>

    </tr>

    <tr>
        <td>Body</td>
        <td>
            <?php echo form_textarea('body', set_value('body',$project->body), 'class="tinymce"'); ?>

        </td>

    </tr>


    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Submit', 'class="btn btn-primary"'); ?></td>

    </tr>

</table>
<?php echo form_close(); ?>

<script>
    $(function () {
        $('.datepicker').datepicker({ format: 'yyyy-mm-dd'});

    });

</script>


