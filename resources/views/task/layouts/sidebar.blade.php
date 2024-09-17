<style>
    .sidebar-wrapper .metismenu a.active,
    .sidebar-wrapper .metismenu a.active:hover,
    .sidebar-wrapper .metismenu a.active:focus,
    .sidebar-wrapper .metismenu a.active:active {
        color: #3461ff;
        text-decoration: none;
        background-color: rgb(255 255 255);
        border-left: 4px solid #3461ff;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    }
</style>

<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <!-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> -->
        </div>
        <div>
            <h4 class="logo-text">Dashboard</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('taskList') }}" class="{{ Route::currentRouteName() === 'taskList' ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-tags-fill"></i>
                </div>
                <div class="menu-title">Task List</div>
            </a>
        </li>
        <li></li>
        <a href="{{ route('createTask') }}" class="{{ Route::currentRouteName() === 'createTask' ? 'active' : '' }}">
            <div class="parent-icon"><i class="bi bi-tags-fill"></i>
            </div>
            <div class="menu-title">Add New Task</div>
        </a>

    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
