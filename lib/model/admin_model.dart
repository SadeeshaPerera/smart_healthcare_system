// admin_model.dart
class Admin {
  final String uid;
  final String email;
  final String fullName;
  final String hospitalName;
  final String contactNumber;
  final String role;

  Admin({
    required this.uid,
    required this.email,
    required this.fullName,
    required this.hospitalName,
    required this.contactNumber,
    required this.role,
  });

  Map<String, dynamic> toMap() {
    return {
      'uid': uid,
      'email': email,
      'full_name': fullName,
      'hospital_name': hospitalName,
      'contact_number': contactNumber,
      'role': role,
    };
  }

  factory Admin.fromMap(Map<String, dynamic> map) {
    return Admin(
      uid: map['uid'],
      email: map['email'],
      fullName: map['full_name'],
      hospitalName: map['hospital_name'],
      contactNumber: map['contact_number'],
      role: map['role'],
    );
  }
}
