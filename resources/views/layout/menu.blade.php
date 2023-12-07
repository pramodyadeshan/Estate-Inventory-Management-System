<ul>
  <li>
    <a href="/home">
      <i class="glyphicon glyphicon-home"></i>
      <span>Dashboard</span>
    </a>
  </li>

  @if(Auth::user()->role->group_level !== 2)
  <li>
      <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-user"></i>
      <span>User Management</span>
      </a>
      <ul class="nav submenu">
          <li><a href="/list-user-role">Manage Groups</a> </li>
          <li><a href="/list-users">Manage Users</a> </li>
      </ul>
  </li>
  @endif

  <li>
    <a href="/cate-manage" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Categories</span>
    </a>
  </li>

  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-large"></i>
      <span>Products</span>
    </a>
    <ul class="nav submenu">
       <li><a href="/list-product">Manage product</a> </li>
       <li><a href="/add-product">Add product</a> </li>
   </ul>
  </li>


  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-flag"></i>
      <span>Estates</span>
    </a>
    <ul class="nav submenu">
    @if(Auth::user()->role->group_level !== 1 && Auth::user()->role->group_level != 2)
    <li><a href="/state-manage">Manage Estate</a> </li>
    @endif
    <li><a href="/divi-manage">Manage Division</a> </li>
   </ul>
  </li>

  <li>
    <a href="/media-file" >
      <i class="glyphicon glyphicon-picture"></i>
      <span>Media</span>
    </a>
  </li>

  <li>
      <a href="/list-stock" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
      <span>Stock Management</span>
      </a>
  </li>

  <li>
      <a href="#" class="submenu-toggle">
          <i class="glyphicon glyphicon-list-alt"></i>
          <span>Account Management</span>
      </a>
      <ul class="nav submenu">
          <li><a href="/list-income">Income</a> </li>
          <li><a href="/list-expend">Expenditure</a> </li>
      </ul>
  </li>

  <li>
    <a href="/list-reports" class="submenu-toggle">
      <i class="glyphicon glyphicon-signal"></i>
       <span>Inventory Reports</span>
      </a>
  </li>
<!--
    <li>
        <a href="#" class="submenu-toggle">
            <i class="glyphicon glyphicon-link"></i>
            <span>Conference</span>
        </a>
        <ul class="nav submenu">
            <li><a href="/add-conference-form">Create Conference</a> </li>
            <li><a href="/list-conference">Manage Conference</a> </li>
        </ul>
    </li>-->

  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-question-sign"></i>
      <span>Chat Bot</span>
    </a>
    <ul class="nav submenu">
        <li><a href="/chat">Chat Bot</a> </li>
        @if(Auth::user()->role->group_level != 1 && Auth::user()->role->group_level != 2)
        <li><a href="/manage-chat-bot">Manage Chat Bot</a> </li>
        @endif
   </ul>
  </li>

</ul>
