<?php
if (isset($loginUrl)) { //This setups the redirect if the app requires authorization
    ?>
    <script type="text/javascript">
        top.location.href = '<? echo $loginUrl; ?>'
    </script>
    <?
    exit;
}
?>

<!DOCTYPE html> <html>
    <head>


        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Win With Feature.</title>
        <link href="<?php echo base_url('static'); ?>/css/feature/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('static'); ?>/css/feature/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('static'); ?>/css/feature/colorbox.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('static'); ?>/css/feature/contest.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('static/js'); ?>/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('static/js'); ?>/cufon-yui.js"></script>
        <script type="text/javascript" src="<?php echo base_url('static/js'); ?>/SchulbuchNord_500.font.js"></script>


        <script> Cufon.replace('h1');
            Cufon.replace('.inner-box p.large-font');</script>

        <style type="text/css">
           div#container{
                background-image: url(<?php echo base_url('static/resources/images/') ."/".$competition['0']->background_image ?>);
            }
        </style>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            
            window.is_liked = 0;
            var permsOk = true;

            function checkLoginStatus(response) {
                if (response.status === 'connected') {
                    // the user is logged in and has authenticated your
                    // app, and response.authResponse supplies
                    // the user's ID, a valid access token, a signed
                    // request, and the time the access token
                    // and signed request each expire
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;


                    FB.api({
                        method: 'fql.multiquery',
                        queries: {
                            query1: 'select page_id from page_fan where uid=<?php echo $me['id']; ?> and page_id=<?php echo $page_id; ?>',
                            query2: 'select publish_stream,user_birthday,user_education_history, user_likes,email from permissions where uid = ' + uid
                        }
                    },
                    function(response) {
                        // handle response

                        var liked = response[0].fql_result_set[0];
                        var perms = response[1].fql_result_set[0];

                        // loop over each perm, if any perm is 0 then call FB.login()
                        for (var perm in perms)
                        {
                            if (perms[perm] === "0")
                            {
                                permsOk = false;
                                FB.login(checkLoginStatus, {scope: 'publish_stream,user_birthday,user_education_history,user_likes,email'});
                                break;
                            }

                        }

                        if (typeof liked === "undefined")
                        {
                            
                            $().facebookTrafficPop({
                                timeout: 0,
                                delay: 2,
                                title: "Like us!",
                                message: 'Like us on Facebook then reload to continue to the competition!',
                                url: "https://www.facebook.com/featureclothing",
                                showfaces: false,
                                opacity: 90,
                                share_button: false,
                                closeable: false
                            });

                        }

                    });



                } else if (response.status === 'not_authorized') {
                    // the user is logged in to Facebook,
                    // but has not authenticated your app
                } else {
                    // the user isn't logged in to Facebook.
                }

            } // end check login status


            window.fbAsyncInit = function() {
                FB.init({
                    appId: '<?php echo APP_ID; ?>', // App ID
                    channelUrl: '<?php echo base_url(); ?>channel.php', // Channel File
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    oauth: true,
                    xfbml: true  // parse XFBML
                });

                // Additional initialization code here



                FB.Canvas.scrollTo(0, 0);

                FB.getLoginStatus(checkLoginStatus);
                FB.login(checkLoginStatus, {scope:'email,publish_actions'});

            };

            // Load the SDK Asynchronously
            (function(d) {
                var js, id = 'facebook-jssdk';
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement('script');
                js.id = id;
                js.async = true;
                js.src = "//connect.facebook.net/en_US/all.js";
                d.getElementsByTagName('head')[0].appendChild(js);
            }(document));

        </script> 

        <div id="container">
            <div class="main-box">
                <img src="<?php echo base_url('static'); ?>/images/feature/main-box-bg.png" />
                <div class="main-content">

                    <div class="inner-box">

                        <h1 class="title">the competition</h1>
                        <div class="inner-content">
                            <p class="large-font">
                                <?php echo $competition['0']->description; ?>
                            </p>
                        </div>
                        <img src="<?php echo base_url('static'); ?>/images/feature/inner-box-bot.png" />
                    </div>
                    <div class="inner-box" style="margin-bottom: 0;">
                        <h1 class="title"><?php echo $competition['0']->question; ?></h1>
                        <div class="inner-content">
                            <ul class="food-list">
                                <li>
                                    <img src="<?php echo base_url('static/resources/images/') ."/".$competition['0']->left_image ?>" height="166px" width="167" />
                                    <a href="#correct_content" class="select-btn correct" id="correct"></a>
                                </li>

                                <li>
                                    <img src="<?php echo base_url('static/resources/images/') ."/".$competition['0']->right_image ?>" height="166px" width="167" />
                                    <a href="#incorrect_content" class="select-btn incorrect" id="incorrect" ></a>
                                </li>

                            </ul>
                            <p class="small-font">
                                <?php echo $competition[0]->terms; ?><br /> <br 
                                    /> queries please contact 
                                danny@datamotion.ie
                            </p>
                        </div>
                        <img src="<?php echo base_url('static'); ?>/images/feature/inner-box-bot.png" />

                    </div>

                </div> <img src="<?php echo base_url('static'); ?>/images/feature/main-box-bot.png" />
            </div>
            <div id="footer">
                Powered by: 
                    <a href="<?php echo base_url('admin'); ?>" >
                        <img src="<?php echo base_url('static'); ?>/images/powered_by.png" title="Data Motion" height="90" /></a>
            </div>
        </div>
        <script type="text/javascript">

            $(document).ready(function() {
                $(".correct").colorbox({inline: true});
                $(".incorrect").colorbox({inline: true});
            });

        </script>

        <div style='display:none'>
            <div id='correct_content' style='background:#fffff;'>
                <div class="main-content" style='padding:5px;'>
                    <div class="inner-box">
                        <h1 id="correct_title" class="title">correct answer! fill in form to enter</h1>
                        <div class="inner-content" style='padding: 5px;'>
                            &nbsp;
                            <form id="contest" method="post" action="welcome/entry/<?php echo $competition[0]->id; ?>">
                                <input type="hidden" name="user_id" value="<?php if(isset($me['id'])){ echo $me['id']; }?>">
                                <ol>
                                    <li>
                                        <label for="full_name">Name:</label>
                                            <input type="text" placeholder="your name" name="full_name" value="<?php if(isset($me['first_name'])){ echo $me['first_name'] . ' ' . $me['last_name']; } ?>" required autofocus/>
                                    </li>
                                    <li>
                                        <label for="email">Email Address: </label>
                                            <input type="email" placeholder="your email address" name="email" value="<?php echo $me['email']; ?>" required></li>
                                    
                                    
                                    <br/>
                                    <li><input name ="opt_in" type="checkbox" 
                                               form="contest" 
                                               required><span class="small-font">Please tick the box to enter the 
                                            competition and to receive Feature offers.</span></li>
                                    <li><br /><input type="submit" class="enter-btn" name="submitButton" value=""></li>
                                </ol>
                            </form>
                            <div id="message"></div>
                          
                        </div>
                    </div>
                </div>	
            </div>

            <div id='incorrect_content' style='background:#fffff;'>
                <div class="main-content" style='padding:5px;'>
                    <div class="inner-box">
                        <h1 class="title">incorrect answer!</h1>
                        <div class="inner-content" style='padding: 5px;'>
                            <p class="small-font">
                                Sorry, that wasen't quite the correct answer!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            
            $("#contest").submit(function(event) {
                event.preventDefault();

                var dataString = $("#contest").serialize();

                $.post("welcome/entry", dataString,
                    function(data){
                       
                        $('#contest').hide();
                        $('#cboxClose').hide(); 
                            
                        $('#message').append(data);
                        
                    }, "json");
                     

                return false;  
            });
        
        </script>
        
    </body> 
</html>
