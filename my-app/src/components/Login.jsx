import React from "react";

const Login=()=>{
    return(
    <div className='row justify-content-center'>
        <div className='col-md-6'>
            <form action="" method="post" className='row justify-content-center'>
                <div className='form-group col-lg-12'>
                    <label htmlFor="email" className='col-lg-4'>Email:</label>
                    <input id="email" name="email"  type="email" className='col-lg-12'/>
                    <span type="text" id="emailErrReport"></span>
                </div>
                <div className='form-group col-lg-12'>
                    <label htmlFor="password" className='col-lg-4'>Password:</label>
                    <input id="password" name="password"  type="password" className='col-lg-12'/>
                    <span type="text" id="passwordErrReport"></span>
                </div>
                <div className="form-group col-lg-12">
                    <div id="userReport">
                        
                    </div>
                </div>
                <div className="form-group w-100 d-flex justify-content-center">
                    <input name="login" type="button" value="Login" id='login' button="login"/>
                    
                </div>
                <span>Don't have an account?Click here to<a href="/index"> register</a></span>
                
            </form>
        </div>
        {/* <div className='col-md-6'>
            <form action="" method="post" className='row justify-content-center'>
                <div className='form-group col-lg-12'>
                    <label for="email" className='col-lg-4'>Email:</label>
                    <input id="email" name="email"  type="email" className='col-lg-12'/>
                    <span type="text" id="emailErrReport"></span>
                </div>
                <div className='form-group col-lg-12'>
                    <label for="password" className='col-lg-4'>Password:</label>
                    <input id="password" name="password"  type="password" className='col-lg-12'/>
                    <span type="text" id="passwordErrReport"></span>
                </div>
                <div className="form-group col-lg-12">
                    <div id="userReport">
                         
                    </div>
                </div>
                <div className="form-group w-100 d-flex justify-content-center">
                    <input name="login" type="button" value="Login" id='login' button="login"/>
                    
                </div>
                <span>Don't have an account?Click here to<a href="/index"> register</a></span>
            </form>
        </div> */}
    </div>
    );
}

export default Login;