<!-- ///**
// * Created by IntelliJ IDEA.
// * User: shaym
// * Date: 8/7/18
// * Time: 11:09 AM
// */ -->
    <h3><?php echo empty($user->id)? 'Add a new user' : 'Edit user ' . $user->name;?></h3>
    <?php echo validation_errors(); ?>

    <?php echo form_open(); ?>
    <table class="table">

        <tr>
            <td>Name</td>
            <td>
                <?php echo form_input('name', set_value('name', $user->name)); ?>
            </td>

        </tr>
        <tr>
            <td>Email</td>
            <td>
                <?php echo form_input('email', set_value('email',$user->email)); ?>
            </td>

        </tr>

        <tr>
            <td>Type</td>
            <td>
                <?php
                $options = array(
                    'backer' => 'Backer',
                    'creator' => 'Creator',
                    'admin' => 'Admin');

                echo form_dropdown('type', $options, set_value('type', $user->type) );
                     ?>
            </td>

        </tr>
        <tr>
            <td>Password</td>
            <td><?php echo form_password('password'); ?></td>

        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><?php echo form_password('password_confirm'); ?></td>

        </tr>


        <tr>
            <td></td>
            <td><?php echo form_submit('submit', 'Submit', 'class="btn btn-primary"'); ?></td>

        </tr>

    </table>
    <?php echo form_close(); ?>

