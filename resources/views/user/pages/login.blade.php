@extends('user.master')
@section('content')
<div id="maincontainer">
  <section id="product">
    <div class="container">
      <!--  breadcrumb --> 
      <ul class="breadcrumb">
        <li>
          <a href="#">Home</a>
          <span class="divider">/</span>
        </li>
        <li class="active">Login</li>
      </ul>
       <!-- Account Login-->
      <div class="row">  
        <div class="col-lg-9">
          <h1 class="heading1"><span class="maintext">Login</span><span class="subtext">First Login here to View All your account information</span></h1>
          <section class="newcustomer">
            <h2 class="heading2">New Customer </h2>
            <div class="loginbox">
              <h4 class="heading4"> Register Account</h4>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
              <br>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
              <br>
              <br>
              <a href="{!! url('homesite/getSignup') !!}" class="btn btn-orange">Continue</a>
            </div>
          </section>
          <section class="returncustomer">
            <h2 class="heading2">Returning Customer </h2>
            <div class="loginbox">
              <h4 class="heading4">I am a returning customer</h4>

			  <!-- Show alert message  -->
        @include('admin.blocks.message')
        <!-- End show alert message -->

              <form class="form-vertical" method="post" action="{{ route('postUserLogin') }}">	
			  <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                <fieldset>
                  <div class="control-group">
                    <label  class="control-label">E-Mail Address:</label>
                    <div class="controls">
                      <input type="text" name="email" class="">
					  @if((count($errors) > 0) && ($errors->has('email')))
						{!! $errors->first('email', '<p style="color:red;">:message</p>') !!}
					  @endif
                    </div>
                  </div>
                  <div class="control-group">
                    <label  class="control-label">Password:</label>
                    <div class="controls">
                      <input type="password"name="password"  class="">
					  @if((count($errors) > 0) && ($errors->has('password')))
						{!! $errors->first('password', '<p style="color:red;">:message</p>') !!}
					  @endif
                    </div>
                  </div>
                  <a class="pull-right" href="#">Forgotten Password ?</a>
                  <br>
                  <br>
                  <input type="submit" name="login-btn" class="btn btn-orange" value="Login" style="margin-right:20px;"/>
				  or login with : 
				  <a href="{!! url('homesite/login/google') !!}"><img src="{!! asset('user/img/google.jpg') !!}" alt="" width="30px" height="30px" /></a>
				  
				   <a href="{!! url('homesite/login/facebook') !!}"><img src="{!! asset('user/img/facebook.jpg') !!}" alt="" width="30px" height="30px"/></a>
                </fieldset>
              </form>
            </div>
          </section>
        </div>
        
        <!-- Sidebar Start-->
        <aside class="col-lg-3">
        </aside>
        <!-- Sidebar End-->
      </div>
    </div>
  </section>
</div>

@endsection
