import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';
import 'package:smart_healthcare_system/admin/admin_dashboard.dart';
import 'package:smart_healthcare_system/admin/admin_login_page.dart';
import 'package:smart_healthcare_system/admin/admin_register_page.dart';
import 'package:smart_healthcare_system/firebase_options.dart';
import 'auth_gate.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp(
    options: DefaultFirebaseOptions.currentPlatform,
  );

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'HealSync | Smart Healthcare System',
      theme: ThemeData(
        primarySwatch: Colors.blue,
        scaffoldBackgroundColor: Colors.white,
        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.white,
          elevation: 0,
          iconTheme: IconThemeData(color: Colors.black),
        ),
      ),
      debugShowCheckedModeBanner: false,
      // initialRoute: '/',
      routes: {
        '/': (context) => const AuthGate(),
        '/admin_login': (context) => AdminLoginPage(),
        '/admin_registration': (context) => AdminRegisterPage(),
        '/admin_dashboard': (context) => AdminDashboard(),
      },
    );
  }
}
