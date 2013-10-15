<div class="well">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo base_url('admin/settingsSelectActiveCompetition'); ?>">Competition</a></li>
        <li class="active"><a href="">Like gate</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
            <form action="<?php echo base_url('admin/deleteAdmin'); ?> " method="post" id="tab">
                
                        <div class="control-group">
                            <label class="control-label">Post Text</label>
                            <div class="controls">
                                <textarea value="" class="input-xlarge" name="name">Like us on Facebook then reload to continue to the competition.</textarea>
                                <p class="help-block">This is the text that is shown when the like gate pops up.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Page ID</label>
                            <div class="controls">
                                <input type="text" value="" class="input-xlarge" name="description">
                                <p class="help-block">Checks if users have liked this page with this id.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" value="">Page Url</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="question">
                                <p class="help-block">Url of page fans will have to like.</p>
                            </div>
                        </div>
                        <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                        
                </div>
            </form>


        </div>

    </div>


