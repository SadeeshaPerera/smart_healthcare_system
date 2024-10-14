import 'package:flutter/material.dart';
import 'package:cloud_firestore/cloud_firestore.dart';

class PatientRecordsPage extends StatefulWidget {
  @override
  _PatientRecordsPageState createState() => _PatientRecordsPageState();
}

class _PatientRecordsPageState extends State<PatientRecordsPage> {
  final _formKey = GlobalKey<FormState>();
  final _nameController = TextEditingController();
  final _ageController = TextEditingController();
  final _genderController = TextEditingController();
  final _addressController = TextEditingController();
  final _phoneController = TextEditingController();
  final _diseaseController = TextEditingController();

  @override
  void dispose() {
    _nameController.dispose();
    _ageController.dispose();
    _genderController.dispose();
    _addressController.dispose();
    _phoneController.dispose();
    _diseaseController.dispose();
    super.dispose();
  }

  Future<void> _createRecord() async {
    if (_formKey.currentState!.validate()) {
      await FirebaseFirestore.instance.collection('patients').add({
        'name': _nameController.text,
        'age': _ageController.text,
        'gender': _genderController.text,
        'address': _addressController.text,
        'phone': _phoneController.text,
        'disease': _diseaseController.text,
      });
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Patient record created successfully!')),
      );
      _formKey.currentState!.reset();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Create Patient Record'),
        backgroundColor: Colors.deepPurple[600],
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              TextFormField(
                controller: _nameController,
                decoration: InputDecoration(labelText: 'Name'),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter the patient\'s name';
                  }
                  return null;
                },
              ),
              TextFormField(
                controller: _ageController,
                decoration: InputDecoration(labelText: 'Age'),
                keyboardType: TextInputType.number,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter the patient\'s age';
                  }
                  return null;
                },
              ),
              TextFormField(
                controller: _genderController,
                decoration: InputDecoration(labelText: 'Gender'),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter the patient\'s gender';
                  }
                  return null;
                },
              ),
              TextFormField(
                controller: _addressController,
                decoration: InputDecoration(labelText: 'Address'),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter the patient\'s address';
                  }
                  return null;
                },
              ),
              TextFormField(
                controller: _phoneController,
                decoration: InputDecoration(labelText: 'Phone'),
                keyboardType: TextInputType.phone,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter the patient\'s phone number';
                  }
                  return null;
                },
              ),
              TextFormField(
                controller: _diseaseController,
                decoration: InputDecoration(labelText: 'Disease'),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter the patient\'s disease';
                  }
                  return null;
                },
              ),
              SizedBox(height: 20),
              ElevatedButton(
                onPressed: _createRecord,
                child: Text('Create Record'),
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.deepPurple[600],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

void main() {
  runApp(MaterialApp(
    home: PatientRecordsPage(),
  ));
}
