<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
              <div class="nav">
                  <div class="sb-sidenav-menu-heading">Core</div>
                  <a class="nav-link @if(Route::currentRouteName()=='admin.dashboard') {{'active'}} @endif" href="{{ route('admin.dashboard') }}">
                      <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                      Dashboard
                  </a>
                  <div class="sb-sidenav-menu-heading">Manage Cahtegory</div>
                  <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-category' || Route::currentRouteName()=='admin.category' || Route::currentRouteName()=='admin.edit-category') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                      Category
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse @if(Route::currentRouteName()=='admin.add-category' || Route::currentRouteName()=='admin.category' || Route::currentRouteName()=='admin.edit-category') {{'show'}} @endif" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link @if(Route::currentRouteName()=='admin.add-category') {{'active'}} @endif" href="{{ route('admin.add-category') }}">Add Category</a>
                          <a class="nav-link @if(Route::currentRouteName()=='admin.category' || Route::currentRouteName()=='admin.edit-category') {{'active'}} @endif" href="{{ url('admin/category') }}">View Category</a>
                      </nav>
                  </div>
                  <div class="sb-sidenav-menu-heading">Manage CMS</div>
                  <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-cms' || Route::currentRouteName()=='admin.cmslist' || Route::currentRouteName()=='admin.edit-cms') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsCMS" aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                      CMS
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse @if(Route::currentRouteName()=='admin.add-cms' || Route::currentRouteName()=='admin.cmslist' || Route::currentRouteName()=='admin.edit-cms') {{'show'}} @endif" id="collapseLayoutsCMS" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link @if(Route::currentRouteName()=='admin.add-cms') {{'active'}} @endif" href="{{ route('admin.add-cms') }}">Add CMS</a>
                          <a class="nav-link @if(Route::currentRouteName()=='admin.cmslist' || Route::currentRouteName()=='admin.edit-cms') {{'active'}} @endif" href="{{ route('admin.cmslist') }}">View CMS</a>
                      </nav>
                  </div>
                  <div class="sb-sidenav-menu-heading">Manage Photo Gallery</div>
                  <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-photogallery' || Route::currentRouteName()=='admin.photogallerylist' || Route::currentRouteName()=='admin.edit-photogallery') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPhotoGallery" aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                      Photo Gallery
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse @if(Route::currentRouteName()=='admin.add-photogallery' || Route::currentRouteName()=='admin.photogallerylist' || Route::currentRouteName()=='admin.edit-photogallery') {{'show'}} @endif" id="collapseLayoutsPhotoGallery" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link @if(Route::currentRouteName()=='admin.add-photogallery') {{'active'}} @endif" href="{{ route('admin.add-photogallery') }}">Add Photo Gallery</a>
                          <a class="nav-link @if(Route::currentRouteName()=='admin.photogallerylist' || Route::currentRouteName()=='admin.edit-photogallery') {{'active'}} @endif" href="{{ route('admin.photogallerylist') }}">View Photo Gallery</a>
                      </nav>
                  </div>
                  <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                      <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                      Pages
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                              Authentication
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                  <a class="nav-link" href="login.html">Login</a>
                                  <a class="nav-link" href="register.html">Register</a>
                                  <a class="nav-link" href="password.html">Forgot Password</a>
                              </nav>
                          </div>
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                              Error
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                  <a class="nav-link" href="401.html">401 Page</a>
                                  <a class="nav-link" href="404.html">404 Page</a>
                                  <a class="nav-link" href="500.html">500 Page</a>
                              </nav>
                          </div>
                      </nav>
                  </div>
                  <div class="sb-sidenav-menu-heading">Addons</div>
                  <a class="nav-link" href="charts.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                      Charts
                  </a>
                  <a class="nav-link" href="tables.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                      Tables
                  </a> -->
              </div>
          </div>
          <div class="sb-sidenav-footer">
              <div class="small">Logged in as:</div>
              Start Bootstrap
          </div>
      </nav>
  </div>
  <div id="layoutSidenav_content">
    <main>
      @yield('unique-content')
    </main>  
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
  </div>
</div>