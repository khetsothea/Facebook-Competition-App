<script type ="text/javascript">
    $(document).ready(function () {

        $('#inputForm').validate({
            ignore: '',
            rules: {
                name: {

                    required: true
                },
                description: {
                    required: true
                },
                question: {

                    required: true
                },
                terms: {
                    required: true
                },
                confirmation_message: {
                    required: true
                },
                wall_post_text: {

                    required: true
                },
                wall_post_link: {

                    required: true
                },
                wall_post_description: {

                    required: true
                },
                image_link: {

                    required: true
                }
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

<div class="row">
    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('admin/addcompetition'); ?> " method="post" id="inputForm">
        <div class="span7">
            <fieldset>
                <legend>Competition Details</legend>
                <div class="control-group">
                    <label class="control-label" for="input01">Name</label>
                    <div class="controls">
                        <input type="text" value="Hat Competition" class="input-xlarge" name="name">
                        <p class="help-block">Hat Competition etc...</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">Description</label>
                    <div class="controls">
                        <input type="text" value="" class="input-xlarge" name="description">
                        <p class="help-block">Details of prize to be won</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" value="" for="input01">Question</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="question">
                        <p class="help-block">The question users have to answer.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Terms & Conditions</label>			
                    <div class="controls">
                        <textarea name="terms"  rows="3" class="input-xlarge">Feature. is a registered trademark of Feature ltd | this promotion is not associated with Facebook.</textarea>
                        <p class="help-block">Displayed below the competition.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Confirmation Message</label>			
                    <div class="controls">
                        <textarea name="confirmation_message"  rows="3" class="input-xlarge">The winner will be announced shortly, keep up to date with the page!</textarea>
                        <p class="help-block">This is shown in the box after form is submitted.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">Background Image</label>
                    <div class="controls">
                        <input name="file" type="file"/>

                    </div>
                    <label class="control-label" for="input01">Left Image</label>
                    <div class="controls">
                        <input name="left_image" type="file"/>

                    </div>
                    <label class="control-label" for="input01">Right Image</label>
                    <div class="controls">
                        <input name="right_image" type="file"/>

                    </div>
                </div>
            </fieldset>
        </div>
        <div class="span7">
            <fieldset>
                <legend>Wall Post</legend>
                <div class="control-group">
                    <label class="control-label" for="input01">Post Text</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="wall_post_text">
                        <p class="help-block">Whats posted to the users wall when they enter.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">Link Text</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="wall_post_link">
                        <p class="help-block">The text of the link back to the competition.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Brand Description</label>			
                    <div class="controls">
                        <textarea name="wall_post_description" value="" rows="3" class="input-xlarge"></textarea>
                        <p class="help-block">Small paragraph of text accompanying wall post.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">Image Link</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" value="http://i.imgur.com/bz7gTg7.jpg" name="image_link">
                        <p class="help-block">Imgur link to square image to acompany wall post.</p>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </fieldset>
        </div>
    </form>
</div>