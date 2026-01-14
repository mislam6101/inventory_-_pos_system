<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{url('')}}/index.html" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{url('')}}/assets/images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{url('')}}/assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{url('')}}/index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{url('')}}/assets/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{url('')}}/assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Executive</li>

            <li class="side-nav-item">
                <a href="{{url('executive/dashboard')}}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="{{url('')}}/#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('category.index')}}">Category</a>
                        </li>
                        <li>
                            <a href="{{route('product.index')}}">Product List</a>
                        </li>
                        <li>
                            <a href="{{route('product.create')}}">Stock Count</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="{{url('')}}/#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI" class="side-nav-link">
                    <i class="ri-briefcase-line"></i>
                    <span> Sale </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBaseUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('')}}/ui-accordions.html">Sale List</a>
                        </li>
                        <li>
                            <a href="{{url('')}}/ui-alerts.html">POS</a>
                        </li>
                        <li>
                            <a href="{{url('')}}/ui-avatars.html">Add Sale</a>
                        </li>
                        <li>
                            <a href="{{url('')}}/ui-buttons.html">Sale Return</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="{{url('')}}/#sidebarForms" aria-expanded="false" aria-controls="sidebarForms" class="side-nav-link">
                    <i class="ri-survey-line"></i>
                    <span> Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarForms">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('')}}/form-advanced.html">Best Seller</a>
                        </li>
                        <li>
                            <a href="{{url('')}}/form-validation.html">Daily Sale</a>
                        </li>
                        <li>
                            <a href="{{url('')}}/form-image-crop.html">Product Expiry Report</a>
                        </li>
                        <li>
                            <a href="{{url('')}}/form-x-editable.html">Product Quantity Alert</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <div data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarTables" class="side-nav-link text-center">
                    <span><form action="{{route('executive.logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </form></span>
                </div>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
