<?php
session_start();
if ($_GET['module']=='dashboard'){
    if ($_SESSION['status_user']==='SuperAdmin' OR $_SESSION['status_user']==='admin'){
      include "dashboard.php";
    }
}

elseif ($_GET['module']=='master_jk'){
    if ($_SESSION['status_user']=='SuperAdmin' OR $_SESSION['status_user']=='admin'){
      include "modul/modul_jk.php";
    }
}

elseif ($_GET['module']=='master_status_pasien'){
    if ($_SESSION['status_user']=='SuperAdmin'){
      include "modul/modul_sp.php";
    }
}

elseif ($_GET['module']=='master_pasien'){
    if ($_SESSION['status_user']=='SuperAdmin' OR $_SESSION['status_user']=='admin'){
      include "modul/modul_pasien_master.php";
    }
}

elseif ($_GET['module']=='master_status_user'){
    if ($_SESSION['status_user']=='SuperAdmin' OR $_SESSION['status_user']=='admin'){
      include "modul/modul_su.php";
    }
}

elseif ($_GET['module']=='pasien'){
    if ($_SESSION['status_user']=='SuperAdmin' OR $_SESSION['status_user']=='admin'){
      include "modul/modul_pasien.php";
    }
}
elseif ($_GET['module']=='user'){
    if ($_SESSION['status_user']=='SuperAdmin' OR $_SESSION['status_user']=='admin'){
      include "modul/modul_user.php";
    }
}

?>