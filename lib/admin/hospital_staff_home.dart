import 'package:flutter/material.dart';

class HospitalStaffHome extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title:
            Text('Hospital Staff Home', style: TextStyle(color: Colors.white)),
        //change back button color
        iconTheme: IconThemeData(color: Colors.white),
        backgroundColor: Colors.deepPurple[600],
      ),
      body: LayoutBuilder(
        builder: (context, constraints) {
          if (constraints.maxWidth > 600) {
            // Web layout
            return Padding(
              padding: const EdgeInsets.all(32.0),
              child: Row(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Welcome, Staff!',
                          style: TextStyle(
                            fontSize: 32,
                            fontWeight: FontWeight.bold,
                            color: Colors.deepPurple[600],
                          ),
                        ),
                        SizedBox(height: 20),
                        Text(
                          'Here are your tasks for today:',
                          style: TextStyle(
                            fontSize: 24,
                            color: Colors.black87,
                          ),
                        ),
                        SizedBox(height: 20),
                        Expanded(
                          child: ListView(
                            children: [
                              ListTile(
                                leading: Icon(Icons.assignment,
                                    color: Colors.deepPurple[600]),
                                title: Text('Check Patient Records'),
                                onTap: () {
                                  // Navigate to patient records page
                                },
                              ),
                              ListTile(
                                leading: Icon(Icons.medical_services,
                                    color: Colors.deepPurple[600]),
                                title: Text('Manage Appointments'),
                                onTap: () {
                                  // Navigate to manage appointments page
                                },
                              ),
                              ListTile(
                                leading: Icon(Icons.local_hospital,
                                    color: Colors.deepPurple[600]),
                                title: Text('Update Inventory'),
                                onTap: () {
                                  // Navigate to update inventory page
                                },
                              ),
                              ListTile(
                                leading: Icon(Icons.report,
                                    color: Colors.deepPurple[600]),
                                title: Text('Generate Reports'),
                                onTap: () {
                                  // Navigate to generate reports page
                                },
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                  Expanded(
                    child: Center(
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Image.asset('assets/images/hospital_staff.jpg'),
                          SizedBox(height: 20),
                        ],
                      ),
                    ),
                  )
                ],
              ),
            );
          } else {
            // Mobile layout
            return Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Welcome, Hospital Staff!',
                    style: TextStyle(
                      fontSize: 24,
                      fontWeight: FontWeight.bold,
                      color: Colors.deepPurple[600],
                    ),
                  ),
                  SizedBox(height: 20),
                  Text(
                    'Here are your tasks for today:',
                    style: TextStyle(
                      fontSize: 18,
                      color: Colors.black87,
                    ),
                  ),
                  SizedBox(height: 10),
                  Expanded(
                    child: ListView(
                      children: [
                        ListTile(
                          leading: Icon(Icons.assignment,
                              color: Colors.deepPurple[600]),
                          title: Text('Check Patient Records'),
                          onTap: () {
                            // Navigate to patient records page
                          },
                        ),
                        ListTile(
                          leading: Icon(Icons.medical_services,
                              color: Colors.deepPurple[600]),
                          title: Text('Manage Appointments'),
                          onTap: () {
                            // Navigate to manage appointments page
                          },
                        ),
                        ListTile(
                          leading: Icon(Icons.local_hospital,
                              color: Colors.deepPurple[600]),
                          title: Text('Update Inventory'),
                          onTap: () {
                            // Navigate to update inventory page
                          },
                        ),
                        ListTile(
                          leading:
                              Icon(Icons.report, color: Colors.deepPurple[600]),
                          title: Text('Generate Reports'),
                          onTap: () {
                            // Navigate to generate reports page
                          },
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            );
          }
        },
      ),
    );
  }
}

void main() {
  runApp(MaterialApp(
    home: HospitalStaffHome(),
  ));
}
