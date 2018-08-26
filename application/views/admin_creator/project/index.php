<!-- ///**
// * Created by IntelliJ IDEA.
// * project: shaym
// * Date: 8/7/18
// * Time: 11:09 AM
// */ -->
<section>
    <h2>Projects</h2>
    <?php echo anchor('admin_creator/project/edit', '<i class="icon-plus"></i>Add a Project');?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Publish Date</th>
            <th>Deadline</th>
            <th>Goal</th>
            <th>Backers</th>
            <th>Pledged</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
        </thead>
        <tbody>
<?php if (count($projects)): foreach ($projects as $project): ?>
        <tr>

            <td><?php echo anchor('admin_creator/project/edit/' . $project->id, $project->title); ?></td>
            <td><?php echo $project->pubdate; ?></td>
            <td><?php echo $project->deadline; ?></td>
            <td><?php echo $project->goal; ?></td>
            <td><?php echo $project->backers; ?></td>
            <td><?php echo $project->pledged; ?></td>

            <td><?php echo btn_edit('admin_creator/project/edit/'. $project->id); ?></td>
        <td><?php echo btn_delete('admin_creator/project/delete/'. $project->id); ?></td>
    </tr>
<?php endforeach; ?>

<?php else: ?>
        <tr>
            <td colspan="3">We could not find any projects.</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</section>