<?php
    include_once('fixedParts/header.php');
    //var_dump($_SERVER['PATH_INFO']);
?>
<main class='container'> 
    <div class='row justify-content-center'>
        <div class='col-md-6'>
            <form action="" method="post" class='row justify-content-center'>
                <div class='form-group col-lg-12'>
                    <label for="fName" class='col-lg-4'>First name:</label> 
                    <input id="fName" name="fName"  type="text" class='col-lg-12'/>
                    <span type="text" id="fnameErrReport"></span>
                </div>
                <div class='form-group col-lg-12'>
                    <label for="lName" class='col-lg-4'>Last name:</label> 
                    <input id="lName" name="lName"  type="text" class='col-lg-12'/>
                    <span type="text" id="lnameErrReport"></span>
                </div>
                <div class='form-group col-lg-12'>
                    <label for="username" class='col-lg-4'>Username:</label> 
                    <input id="username" name="username"  type="text" class='col-lg-12'/>
                    <span type="text" id="usernameErrReport"></span>
                </div>
                <div class='form-group col-lg-12'>
                    <label for="email" class='col-lg-4'>Email:</label>
                    <input id="email" name="email"  type="email" class='col-lg-12'/>
                    <span type="text" id="emailErrReport"></span>
                </div>

                <!-- <div class='form-group'>
                    <label for="email">Email:</label>
                    <input id="email" name="email"  type="email" />
                </div> -->
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
                    <input name="register" type="button" value="Register" id='register' button="register"/>
                    
                </div>
                <span>If you have an account, <a href="/login">click here</a></span>
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