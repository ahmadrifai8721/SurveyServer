<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('home') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ url('/') }}/assets/images/logo.png" alt="logo" style="height: 50px;">
        </span>
        <span class="logo-sm">
            <img src="{{ url('/') }}/assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('home') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ url('/') }}/assets/images/logo-dark.png" alt="dark logo" style="height: 50px;">
        </span>
        <span class="logo-sm">
            <img src="{{ url('/') }}/assets/images/logo-dark-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="align-middle ri-checkbox-blank-circle-line"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="align-middle ri-close-fill"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        {{--
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="{{ url('/') }}/assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                    class="shadow-sm rounded-circle">
                <span class="mt-2 leftbar-user-name">Admin</span>
            </a>
        </div> --}}

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Website</li>
            <li class="side-nav-item">
                <a href="{{ route('home') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('survey') }}" class="side-nav-link">
                    <i class="ri-line-chart-line"></i>
                    <span> Daftar hasil Survey</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('respondent.index') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Daftar Responden </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms"
                    class="side-nav-link">
                    <i class="mdi mdi-food-variant"></i>
                    <span> Food Recal</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarForms">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('foodRecall.index') }}"> Food Recal Report</a>
                        </li>

                        <li>
                            <a href="{{ route('daftarBalita.index') }}">Daftar Balita</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('Administrator.index') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Administrator </span>
                </a>
            </li>

            <li class="side-nav-title">Apps</li>

            <li class="side-nav-item">
                <a href="{{ route('APK.index') }}" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span> File APK </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a href="{{ route('TopInfo.index') }}" class="side-nav-link">
                    <i class=" uil-books"></i>
                    <span> Top Info </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('materi.index') }}" class="side-nav-link">
                    <i class=" uil-books"></i>
                    <span> material files / pdf files </span>
                </a>
            </li>

            <!-- Help Box -->
            <div class="text-center text-white help-box">
                <a href="javascript: void(0);" class="text-white float-end close-btn">
                    <i class="mdi mdi-close"></i>
                </a>
                <img src="{{ url('/') }}/assets/images/svg/help-icon.svg" height="90"
                    alt="Helper Icon Image" />
                <h5 class="mt-3">Kiss Bunda</h5>
                <p class="mb-3">Dashboard Survey Kepuasan Kiss Bunda</p>
            </div>
            <!-- end Help Box -->


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
