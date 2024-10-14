<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.10/jspdf.plugin.autotable.min.js"></script>
        
    <title>Appointments</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        #appointmentChart {
            width: 60%;  /* Adjust the percentage based on your desired width */
            height: 300px;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
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

    // Query to get appointment data for today
    $query = "
        SELECT 
            HOUR(s.scheduletime) AS appointment_hour,
            COUNT(a.appoid) AS appointment_count
        FROM 
            appointment a
        JOIN 
            schedule s ON a.scheduleid = s.scheduleid
        WHERE 
            DATE(s.scheduletime) = CURDATE()  -- Filter by today's date
        GROUP BY 
            appointment_hour
        ORDER BY 
            appointment_hour;
    ";

    $result = $database->query($query);

    // Initialize arrays to hold hours and appointment counts
    $appointment_hours = range(0, 23);  // All hours from 0 to 23
    $appointment_counts = array_fill(0, 24, 0);  // Default all counts to 0

    // Fetch the results and update the counts
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment_hour = $row['appointment_hour'];
            $appointment_count = $row['appointment_count'];

            // Map the hour to the corresponding count
            $appointment_counts[$appointment_hour] = $appointment_count;
        }
    }
    
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
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <h3 style="font-size: 20px; font-weight: 600; padding-left: 12px;">Report Types</h3>
                    <button id="generatePdfBtn" style="
                        background-color: #4CAF50; 
                        border: none; 
                        color: white; 
                        padding: 14px 20px; 
                        text-align: center; 
                        font-size: 16px; 
                        margin: 10px 0; 
                        cursor: pointer; 
                        border-radius: 8px; 
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
                        transition: all 0.3s ease;
                        display: inline-block; 
                        margin-left: auto; 
                        margin-right: 20px;">
                        Generate PDF
                    </button>
                </div>

                <table width="100%" style="margin-top: 20px;">
                    <tr>
                        <td width="12%">
                            <a href="#">
                                <button type="button" class="btn-primary-soft btn button-icon" style="padding: 15px; margin: 0; width: 100%; background-color: #003366; color: white;">
                                    Analyze Peak Hours
                                </button>
                            </a>
                        </td>
                        <td width="12%">
                            <a href="patient_count.php">
                                <button type="button" class="btn-primary-soft btn button-icon" style="padding: 15px; margin: 0; width: 100%;">
                                    Patient Count
                                </button>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            // Assuming you have a database connection already established

            $query = "
                SELECT 
                    HOUR(s.scheduletime) AS appointment_hour,
                    COUNT(a.appoid) AS appointment_count
                FROM 
                    appointment a
                JOIN 
                    schedule s ON a.scheduleid = s.scheduleid
                WHERE 
                    DATE(s.scheduletime) = CURDATE()  -- Optional: filter by today's date
                GROUP BY 
                    appointment_hour
                ORDER BY 
                    appointment_count DESC, appointment_hour;
            ";

            $result = $database->query($query);

            // Check if there are results
            if ($result->num_rows > 0) {
                echo "<table border='1' style='width:75%; margin:20px auto; border-collapse: collapse;'>";
                echo "<tr style='background-color: #e0e0e0; font-weight: bold;'>";
                echo "<th style='padding: 10px; text-align: left; border: 3px solid #ddd;'>Hour</th>";
                echo "<th style='padding: 10px; text-align: left; border: 3px solid #ddd;'>Number of Appointments</th>";
                echo "</tr>";

                // Fetch and display each row
                while ($row = $result->fetch_assoc()) {
                    $hour = $row['appointment_hour'];
                    $appointment_count = $row['appointment_count'];

                    // Ensure hours are displayed in 24-hour format with leading zeros if necessary
                    $start_time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00";
                    $end_time = str_pad(($hour + 1) % 24, 2, '0', STR_PAD_LEFT) . ":00"; // Wrap around for the 24th hour (midnight)

                    echo "<tr style='background-color: #fff;'>";
                    echo "<td style='padding: 10px; border: 3px solid #ddd;'>" . $start_time . " - " . $end_time . "</td>";
                    echo "<td style='padding: 10px; border: 3px solid #ddd;'>" . $appointment_count . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

            } else {
                echo "No appointment data available.";
            }
            ?>

            <!-- Appointment Chart (Canvas) -->
            <h4 style="font-size: 18px; font-weight: 600; padding-left: 12px; text-align: center;">Appointment Count by Hour</h4>
            <canvas id="appointmentChart"></canvas>

        </div>
    </div>
    <script>
        // Chart.js script for Bar Chart
        const ctx = document.getElementById('appointmentChart').getContext('2d');
        const appointmentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($appointment_hours); ?>,  // Hour labels 0-23
                datasets: [{
                    label: 'Appointments',
                    data: <?php echo json_encode($appointment_counts); ?>,  // Appointment counts
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
    document.getElementById("generatePdfBtn").addEventListener("click", function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add the title and date at the top of the PDF
        doc.text("Appointment Report", 20, 20);
        doc.text("Date: " + new Date().toLocaleDateString(), 20, 30);

        // Appointment data from PHP embedded into JavaScript
        const appointmentData = <?php
            // Fetch data from the PHP array and convert it to a JSON format
            $appointmentData = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $appointmentData[] = [
                        'hour' => str_pad($row['appointment_hour'], 2, '0', STR_PAD_LEFT) . ":00 - " . 
                                 str_pad(($row['appointment_hour'] + 1) % 24, 2, '0', STR_PAD_LEFT) . ":00",
                        'appointments' => $row['appointment_count']
                    ];
                }
            }
            echo json_encode($appointmentData);
        ?>;

        // Table columns
        const columns = [
            { header: 'Hour', dataKey: 'hour' },
            { header: 'Appointments', dataKey: 'appointments' }
        ];

        // Generate the table in the PDF
        doc.autoTable({
            head: [columns.map(col => col.header)],  // Extract header names
            body: appointmentData, // Table data
            startY: 40, // Start the table below the title
            theme: 'grid', // Table theme
            margin: { horizontal: 10 }, // Add margin
            styles: {
                fontSize: 10,
                cellPadding: 5,
                halign: 'center', // Align text to the center of the cell
            }
        });

        // Save the document
        doc.save("appointment_report.pdf");
    });
</script>

    
</body>
</html>