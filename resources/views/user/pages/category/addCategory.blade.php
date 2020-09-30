@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-list"></i>
   </div>
   <div class="header-title">
      <h1>Add Category</h1>
      <small>The categories you want to store</small>
   </div>
</section>
<section class="content">
	<div class="col-sm-6">
	 <div class="panel lobidisable panel-bd">
	    <div class="panel-heading">
	       <div class="panel-title">
	          <h4>Category</h4>
	       </div>
	    </div>
	    <div class="panel-body">
	       <div class="table-responsive">
	          <form method="post" action="{{ route('save.category') }}">
	          	@csrf
				  <div class="form-group">
				    <label for="category">Category Name</label>
				    <input type="text" name="category_name" class="form-control" id="category" aria-describedby="category" placeholder="Enter category">
				  </div>
				  <div class="form-group">
				    <label for="textarea">Description</label>
				    <textarea name="description" class="form-control" cols="55" rows="7"></textarea>
				  </div>
				  <div class="form-check">
				    <button type="submit" class="pull-right btn btn-primary">Submit</button>
				  </div>
				</form>
	       </div>
	    </div>
	 </div>
	</div>
	<div class="col-sm-6">
		@include('user.inc.message')
	</div>
</section>
@endsection