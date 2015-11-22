<div id="navbar" class="navbar-collapse collapse">
@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Sai mật khẩu hoặc username rồi.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
<form class="navbar-form navbar-right" role="form" method="POST" action="{{ url('/auth/login') }}">
{!! csrf_field() !!}
    <div class="form-group">
      <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
    </div>
    <div class="form-group">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> <span style="color: white">Ghi nhớ</span>
				</label>
			</div>
	</div>
	<div class="form-group">
			<button type="submit" class="btn btn-primary">Đăng nhập</button>
			<a type="submit" class="btn btn-warning" href="/auth/register">Đăng ký</a>

			<a class="btn btn-link" href="{{ url('/password/email') }}">Quên mật khẩu?</a>
	</div>
  </form>
</div><!--/.navbar-collapse -->