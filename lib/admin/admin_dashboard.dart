import 'package:flutter/material.dart';

class AdminDashboard extends StatefulWidget {
  const AdminDashboard({super.key});

  @override
  _AdminDashboardState createState() => _AdminDashboardState();
}

class _AdminDashboardState extends State<AdminDashboard> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Admin Dashboard'),
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: <Widget>[
            const DrawerHeader(
              child: Text('Menu'),
              decoration: BoxDecoration(
                color: Colors.blue,
              ),
            ),
            ListTile(
              title: Text('Patients'),
              onTap: () {
                // Navigate to Patients section
              },
            ),
            ListTile(
              title: Text('Appointments'),
              onTap: () {
                // Navigate to Appointments section
              },
            ),
            ListTile(
              title: Text('Doctors'),
              onTap: () {
                // Navigate to Doctors section
              },
            ),
          ],
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: GridView.count(
          crossAxisCount: 2,
          children: <Widget>[
            DashboardCard(title: 'Patients', icon: Icons.people),
            DashboardCard(title: 'Appointments', icon: Icons.calendar_today),
            DashboardCard(title: 'Doctors', icon: Icons.local_hospital),
            DashboardCard(title: 'Reports', icon: Icons.report),
          ],
        ),
      ),
    );
  }
}

class DashboardCard extends StatelessWidget {
  final String title;
  final IconData icon;

  DashboardCard({required this.title, required this.icon});

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 4,
      child: InkWell(
        onTap: () {
          // Handle card tap
        },
        child: Center(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: <Widget>[
              Icon(icon, size: 50),
              SizedBox(height: 10),
              Text(title, style: TextStyle(fontSize: 18)),
            ],
          ),
        ),
      ),
    );
  }
}
