<nav class="navbar navbar-expand-sm navbar-dark">
    <div class="name mr-auto d-flex align-items-center">
        <button type="button" id="sidebarCollapse" class="btn btn-light">
            <i class="fas fa-align-left"></i>
        </button>
        <h5>Tracer Study Universitas Tarumanagara</h5>
    </div>
    <div class="admin-name">
        <h5>{{ Auth::user()->name }} </h5>
        <p>{!! str_replace(str_split('[""]'), '', Auth::user()->getRoleNames() ) !!}</p>
    </div>
</nav>
