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
        <li class="active">Register Account</li>
      </ul>
      <div class="row">        
        <!-- Register Account-->
        <div class="col-lg-9">
          <h1 class="heading1"><span class="maintext">Register Account</span><span class="subtext">Register Your details with us</span></h1>

		  <!-- Show alert message  -->
      @include('admin.blocks.message')
      <!-- End show alert message -->  

          <form class="form-horizontal" method="post" action="{!! route('postSignup') !!}">   
		  <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 		
		  <h3 class="heading3">Your Information</h3>		  
            <div class="registerbox">
              <fieldset>
				<div class="control-group">
                  <label  class="control-label"><span class="red">*</span> Username:</label>
                  <div class="controls">
                    <input type="text" name="name" class="input-xlarge">
					@if(count($errors) > 0 && $errors->has('name'))
					 {!! $errors->first('name', '<span style="color:red;">:message</span>') !!}
					@endif
                  </div>
                </div>
                <div class="control-group">
                  <label  class="control-label"><span class="red">*</span> Password:</label>
                  <div class="controls">
                    <input type="password" name="password" class="input-xlarge">
					@if((count($errors) >0) && ($errors->has('password')))
					 {!! $errors->first('password', '<span style="color:red;">:message</span>') !!}
					@endif
                  </div>
                </div>
                <div class="control-group">
                  <label  class="control-label"><span class="red">*</span> LPassword Confirm:</label>
                  <div class="controls">
                    <input type="password" name="c_password" class="input-xlarge">
					@if((count($errors) >0) && ($errors->has('c_password')))
					 {!! $errors->first('c_password', '<span style="color:red;">:message</span>') !!}
					@endif
                  </div>
                </div>
				<div class="control-group">
                  <label  class="control-label"><span class="red">*</span> Email:</label>
                  <div class="controls">
                    <input type="text" name="email" class="input-xlarge">
					@if((count($errors) >0) && ($errors->has('email')))
					 {!! $errors->first('email', '<span style="color:red;">:message</span>') !!}
					@endif
                  </div>
                </div>
              </fieldset>
            </div>
            
            <div class="pull-right">             
              <input type="Submit" class="btn btn-orange" value="Continue">
            </div>
          </form>
          <div class="clearfix"></div>
          <br>
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
