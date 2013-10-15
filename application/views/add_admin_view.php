<script type ="text/javascript">
    $(document).ready(function () {

        $('#adminForm').validate({
            ignore: '',
            rules: {
                facebookId: {
                    required: true,
                    number: true
                }
            },
            messages: {
                facebookId: "Please enter a valid Facebook ID"
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element
                    .text('OK!').addClass('valid')
                    .closest('.control-group').removeClass('error').addClass('success');
            }
        });
    }); // end document.ready
    
</script>

<div class="well">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo base_url('admin/manageAdmin'); ?>" >Manage</a></li>
        <li class="active"><a href="#profile" data-toggle="tab">Add</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">

            <form action="<?php echo base_url('admin/addAdmin'); ?> " method="post" id="adminForm">
                <div class="control-group">
                    <label class="control-label">Facebook User Id:</label>
                    <div class="controls">
                        <input type="text" name="facebookId" class="input-xlarge" required>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>