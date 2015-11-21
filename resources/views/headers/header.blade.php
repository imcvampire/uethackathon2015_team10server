  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">HowToLearn</a>
        </div>
        @if (\Auth::user() == null)
          @include ('auth.login')
        @else
          <ul id="navbar" class="nav navbar-nav navbar-right">
          <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ \Auth::user()->name }}
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/users/profile">Profile</a></li>
            <li><a href="/auth/logout">Đăng xuất</a></li>
          </ul>
        </li>
      </ul>
        @endif
      </div>
    </nav>