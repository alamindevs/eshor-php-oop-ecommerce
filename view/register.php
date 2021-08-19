<?php require_once "partials/_accounthader.php";?>
  <!-- Sign up form -->
  <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="/register" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                                <?php if ( !empty( $_SESSION['errors']['name'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['name']?></span>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="username" name="username" id="username" placeholder="Your username"/>
                                <?php if ( !empty( $_SESSION['errors']['username'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['username']?></span>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email" id="email" placeholder="Your Email"/>
                                <?php if ( !empty( $_SESSION['errors']['username'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['username']?></span>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="phone" name="phone" id="phone" placeholder="Your phone"/>
                                <?php if ( !empty( $_SESSION['errors']['phone'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['phone']?></span>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                                <?php if ( !empty( $_SESSION['errors']['password'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['password']?></span>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat your password"/>
                                <?php if ( !empty( $_SESSION['errors']['confirm_password'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['confirm_password']?></span>
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                                <?php if ( !empty( $_SESSION['errors']['agree-term'] ) ) {?>
                                    <span style="color:red;"><?=$_SESSION['errors']['agree-term']?></span>
                                <?php }
                                    unset( $_SESSION['errors'] );
                                ?>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/accountfrom/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="/login" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
 <?php require_once "partials/_accountfooter.php";?>