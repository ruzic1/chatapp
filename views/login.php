<?php
    include_once('fixedParts/header.php');
?>
<main class='container'> 
    <div class='row justify-content-center'>
        <div class='col-md-6'>
            <form action="" method="post" class='row justify-content-center'>
                <div class='form-group col-lg-12'>
                    <label for="email" class='col-lg-4'>Email:</label>
                    <input id="email" name="email"  type="email" class='col-lg-12'/>
                    <span type="text" id="emailErrReport"></span>
                </div>
                <div class='form-group col-lg-12'>
                    <label for="password" class='col-lg-4'>Password:</label>
                    <input id="password" name="password"  type="password" class='col-lg-12'/>
                    <span type="text" id="passwordErrReport"></span>
                </div>
                <div class="form-group col-lg-12">
                    <div id="userReport">
                        
                    </div>
                </div>
                <div class="form-group w-100 d-flex justify-content-center">
                    <input name="login" type="button" value="Login" id='login' button="login"/>
                    
                </div>
                <span>Don't have an account?Click here to<a href="/index"> register</a></span>
                <!-- <div class="alert alert-danger" role="alert">
                    This is a danger alert—check it out!
                </div> -->
            </form>
        </div>
    </div>
</main>

<?php
    include_once('fixedParts/footer.php');
?>