<nav class="navbar navbar-light navbar-expand-md" style="background-color: #a020f0;">
	<div class="navbar-brand-wrapper">
		<a class="navbar-brand" href="{{ route('manage.dashboard') }}">
			@lang('common.brand') @php echo (env('APP_ENV') != 'production' ? "(".env('APP_ENV').")" : "") @endphp
		</a>
	</div>
	<button class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent"
		aria-expanded="false" aria-label="Toggle navigation">
		<i class="c_icon fas fa-list"></i>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
		@if(Auth::guard('admin')->check())
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.dashboard') }}">
					<i class="c_icon fas fa-home menu-icon"></i> @lang('common.dashboard')
				</a>
			</li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="c_icon fas fa-database menu-icon"></i> @lang('common.master')
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="{{ route('manage.admin.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-user-shield menu-icon"></i> @lang('common.admin')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.customer.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-user menu-icon"></i> @lang('common.customer')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.supplier.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-truck-field menu-icon"></i> @lang('common.supplier')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.branch.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-location-crosshairs menu-icon"></i> @lang('common.branch')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.bankAccount.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-building-columns menu-icon"></i> @lang('common.bank-account')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.product.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-box menu-icon"></i> @lang('common.product')
						</a>
					</li>
					<li>
						<a href="{{ route('manage.asset.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-vault menu-icon"></i> @lang('common.asset')
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="c_icon fas fa-arrow-right-arrow-left menu-icon"></i> @lang('common.transaction')
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="{{ route('manage.purchase.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-person-arrow-down-to-line menu-icon"></i> @lang('common.purchase')
						</a>
					</li>
        			<li>
						<a href="{{ route('manage.sale.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-person-arrow-up-from-line menu-icon"></i> @lang('common.sale')
						</a>
					</li>
        			<li>
						<a href="{{ route('manage.expense.list') }}" class="dropdown-item">
							<i class="c_icon fas fa-bag-shopping menu-icon"></i> @lang('common.expense')
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.cashier.drawer') }}">
					<i class="c_icon fas fa-cash-register menu-icon"></i> @lang('common.cashier')
				</a>
			</li>
		@endif
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<select id="change-locale-select" class="form-control form-control-sm">
				@foreach(App\Helpers\ApplicationConstant::LANGUAGE as $key => $value)
				<option value="{{$key}}"
					{{ \Session::get('locale') == $key ? 'selected' : '' }}
				>
					@lang('application-constant.LANGUAGE.'.$value)
				</option>
				@endforeach
				</select>
			</li>
			@if(Auth::guard('admin')->check())
			<li class="nav-item">
				<a class="nav-link" href="#">
					Hi, {{ Auth::guard('admin')->user()->name }}
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.setting') }}">
					<i class="c_icon fas fa-cogs menu-icon"></i> @lang('common.setting')
				</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="c_icon fas fa-power-off menu-icon"></i> @lang('common.logout')
					<form id="logout-form"
						action="{{ route('manage.logout')  }}"
						method="POST"
						style="display: none;">
						{{ csrf_field() }}
					</form>
				</a>
			</li>
			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('manage.login') }}">
				  <i class="c_icon fas fa-sign-in-alt menu-icon"></i> @lang('common.login')
				</a>
			</li>
			@endif
		</ul>
	</div>
</nav>