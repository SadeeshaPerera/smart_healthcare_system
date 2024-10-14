<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Appointments</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");

    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule ">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="appointment.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Generate Reports</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;

                        $list110 = $database->query("select  * from  appointment;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                       
            </table>
            <div style="margin-top: 30px;">
                <h3 style="font-size: 20px; font-weight: 600; padding-left: 12px;">Report Types</h3>
                <table width="100%" style="margin-top: 20px;">
                    <tr>
                        <td width="12%">
                            <a href="reports.php">
                                <button type="button" class="btn-primary-soft btn button-icon" style="padding: 15px; margin: 0; width: 100%;">
                                    Analyze Peak Hours
                                </button>
                            </a>
                        </td>
                        <td width="12%">
                            <a href="patient_count.php">
                                <button type="button" class="btn-primary-soft btn button-icon" style="padding: 15px; margin: 0; width: 100%;  background-color: #003366; color: white;">
                                    Patient Count
                                </button>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            // Fetch doctors and their patient count from appointments via schedule
            $query = "
                SELECT 
                    d.docname, COUNT(a.appoid) AS patient_count
                FROM 
                    appointment a
                JOIN 
                    schedule s ON a.scheduleid = s.scheduleid
                JOIN 
                    doctor d ON s.docid = d.docid
                GROUP BY 
                    d.docname
                ORDER BY 
                    patient_count DESC;
            ";

            $result = $database->query($query);

            if ($result->num_rows > 0) {
                echo "<table border='1' style='width:75%; margin:20px auto; border-collapse: collapse;'>";
                echo "<tr style='background-color: #e0e0e0; font-weight: bold;'>";
                echo "<th style='padding: 10px; text-align: left; border: 3px solid #ddd;'>Doctor Name</th>";
                echo "<th style='padding: 10px; text-align: left; border: 3px solid #ddd;'>Number of Patients</th>";
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    $doctor_name = $row['docname'];
                    $patient_count = $row['patient_count'];

                    echo "<tr style='background-color: #fff;'>";
                    echo "<td style='padding: 10px; border: 3px solid #ddd;'>" . $doctor_name . "</td>";
                    echo "<td style='padding: 10px; border: 3px solid #ddd;'>" . $patient_count . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

            } else {
                echo "No data available.";
            }
            ?>
        </div>
    </div>
</body>
</html>