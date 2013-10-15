<div class="well">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Manage</a></li>
        <li><a href="<?php echo base_url('admin/addAdminView'); ?>">Add</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
            <form action="<?php echo base_url('admin/deleteAdmin'); ?> " method="post" id="tab">
                <select name="user_id" id="DropDownTimezone" class="input-xlarge">
                    <?php foreach ($admins as $person) { ?>
                        <?php echo $person->firstname . ' ' . $person->lastname; ?>
                        <option value="<?php echo $person->id; ?>"><?php echo $person->firstname . ' '. $person->lastname; ?></option>

                    <?php } ?>
                </select>
                <div>
                    <button class="btn btn-danger">Remove</button>
                </div>
            </form>


        </div>

    </div>
