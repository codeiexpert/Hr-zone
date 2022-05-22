<?php
$path = '/';
if (isset($_GET['path'])) {
    $path = $_GET['path'];
}
?>
<div id="leftside">
    <div class="leftside-menu" id="leftside">
        <div class="h-100" id="leftside-menu-container" data-simplebar>
            <ul class="side-nav">
                <li class="side-nav-item">
                    <a href="<?php echo site_url().'/hr-zone/'; ?>"
                        class="side-nav-link <?php if ($path == '/'): ?> active <?php endif; ?>" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Dashbaord">
                        <i class="uil uil-dashboard"></i>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="<?php echo site_url().'/hr-zone/?path=candidates'; ?>"
                        class="side-nav-link <?php if ($path == 'candidates' || $path == 'interview-details'): ?> active <?php endif; ?>"
                        data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Scheduled Interviews">
                        <i class="dripicons-inbox"></i>
                    </a>
                </li>

                <!-- <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                <i class="uil uil-briefcase-alt"></i>
                <i class="mdi mdi-dots-vertical"></i>
               
            </a>
            <div class="collapse" id="sidebarDashboards">
                <ul class="side-nav-second-level shadow">
                    <li class="sub-head">
                        Recruitment
                    </li>
                    <li class="select">
                        <a href="recruit.html"><i class="uil uil-search"></i> Recruit</a>
                    </li>
                    <li class="select">
                        <a href="conversations.html"> <i class="uil-comments-alt"></i> Conversations</a>
                    </li>
                    <li class="select">
                        <a href="#"> <i class="dripicons-list"></i> Tasks</a>
                    </li>
                </ul>
            </div>
        </li> -->

                <!-- <li class="side-nav-item">
            <a data-bs-toggle="collapse shadow" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                <i class="dripicons-user-group"></i>
                <i class="mdi mdi-dots-vertical"></i>
                
            </a>
            <div class="collapse" id="sidebarDashboards">
                <ul class="side-nav-second-level shadow">
                    <li class="sub-head">
                        Employees
                    </li>
                    <li class="select">
                        <a href="#"> <i class="uil uil-users-alt"></i> Employee Directory</a>
                    </li>
                    <li class="select">
                        <a href="#"><i class="dripicons-network-3"></i> Org Chart</a>
                    </li>
                    <li class="select">
                        <a href="#"> <i class="dripicons-rocket"></i> Onboarding</a>
                    </li>
                    <li class="select">
                        <a href="#"> <i class="uil uil-exit"></i> Offboarding</a>
                    </li>
                </ul>
            </div>
        </li> -->
                <li class="side-nav-item">
                    <a href="<?php echo site_url().'/hr-zone/?path=email-templates'; ?>"
                        class="side-nav-link  <?php if ($path == 'email-templates'): ?> active <?php endif; ?>"
                        data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Email Templates">
                        <i class="uil uil-chart"></i>

                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="<?php echo site_url().'/hr-zone/?path=settings'; ?>"
                        class="side-nav-link <?php if ($path == 'settings' || $path == 'my-account'): ?> active <?php endif; ?>"
                        data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Settings">
                        <i class="uil uil-cog"></i>

                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>

    </div>
</div>