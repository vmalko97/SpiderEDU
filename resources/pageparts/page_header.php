<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-default has-cover">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo getAppName();?></span> - <?php echo getStudentPageName($_GET['page']);?></h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="?page=main"><i class="icon-home2 position-left"></i><?php echo getAppName();?></a></li>
                <li class="active"><?php echo getStudentPageName($_GET['page']);?></li>
            </ul>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">