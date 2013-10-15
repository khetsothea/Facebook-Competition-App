<div class="well">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Competition</a></li>
        <li><a href="<?php echo base_url('admin/settingsLikeGate'); ?>">Like gate</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
            <form action="<?php echo base_url('admin/setActiveCompetition'); ?> " method="post" id="tab">
                <legend> Set Active Competition </legend>
                <select name="user_id" id="DropDownTimezone" class="input-xlarge">
                    <?php foreach ($competitions as $comps) { ?>
                        <?php echo $comps->name;?>
                        <option value="<?php echo $comps->id; ?>"><?php echo $comps->name;?></option>

                    <?php } ?>
                </select>
                <div>
                    <button class="btn btn-success">Load</button>
                </div>
            </form>


        </div>

    </div>
