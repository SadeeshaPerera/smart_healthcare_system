import 'package:flutter/material.dart';
import 'package:hospital_appointment/admin/hospital_staff_home.dart';
import '../../widget/inputdecoration.dart';
import '../../constants.dart';
import '../../widget/Alert_Dialog.dart';
import '../../componets/loadingindicator.dart';

class HospitalStaffLoginPage extends StatefulWidget {
  const HospitalStaffLoginPage({Key? key}) : super(key: key);

  @override
  _HospitalStaffLoginPageState createState() => _HospitalStaffLoginPageState();
}

class _HospitalStaffLoginPageState extends State<HospitalStaffLoginPage> {
  var _isObscure = true;
  var t_email, t_password;
  final GlobalKey<FormState> _formkey = GlobalKey<FormState>();
  bool isLoading = false;

  @override
  Widget build(BuildContext context) {
    bool isEmailValid(String email) {
      var pattern =
          r'^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
      RegExp regex = new RegExp(pattern);
      return regex.hasMatch(email);
    }

    var size = MediaQuery.of(context).size;

    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Form(
          key: _formkey,
          child: isLoading
              ? Loading()
              : SingleChildScrollView(
                  child: Container(
                    height: size.height * 1,
                    decoration: BoxDecoration(
                      image: DecorationImage(
                          image: AssetImage("assets/images/3.jpeg"),
                          fit: BoxFit.cover),
                    ),
                    child: Container(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          SizedBox(
                            height: size.height * 0.39,
                          ),
                          Container(
                            child: Center(
                                child: Text(
                              "Hospital Staff Login",
                              style: TextStyle(
                                  fontSize: 22,
                                  color: Colors.black,
                                  fontWeight: FontWeight.bold),
                            )),
                          ),
                          SizedBox(
                            height: 10,
                          ),
                          Container(
                            height: 2,
                            width: 150,
                            color: kPrimaryLightColor,
                          ),
                          SizedBox(
                            height: 10,
                          ),
                          SizedBox(
                            height: size.height * 0.02,
                          ),
                          // ************************************
                          // Email Field
                          //*************************************
                          Container(
                            width: size.width * 0.9,
                            child: TextFormField(
                              keyboardType: TextInputType.emailAddress,
                              cursorColor: kPrimaryColor,
                              decoration: buildInputDecoration(
                                  Icons.email, "Your Email "),
                              onChanged: (email) {
                                t_email = email.trim();
                              },
                              validator: (email) {
                                if (isEmailValid(email!))
                                  return null;
                                else
                                  return 'Enter a valid email address';
                              },
                              onSaved: (var email) {
                                t_email = email.toString().trim();
                              },
                            ),
                          ),
                          // ************************************
                          // Password Field
                          //*************************************

                          Container(
                            width: size.width * 0.9,
                            margin: EdgeInsets.all(10),
                            child: TextFormField(
                              obscureText: _isObscure,
                              cursorColor: kPrimaryColor,
                              decoration: InputDecoration(
                                  border: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(25.0),
                                    borderSide: BorderSide(
                                      color: kPrimaryLightColor,
                                      width: 2,
                                    ),
                                  ),
                                  prefixIcon: Icon(
                                    Icons.lock,
                                    color: kPrimaryColor,
                                  ),
                                  suffixIcon: IconButton(
                                    icon: Icon(
                                      _isObscure
                                          ? Icons.visibility_off
                                          : Icons.visibility,
                                      color: kPrimaryColor,
                                    ),
                                    onPressed: () {
                                      setState(() {
                                        _isObscure = !_isObscure;
                                        print("on password");
                                      });
                                    },
                                  ),
                                  fillColor: kPrimaryLightColor,
                                  filled: true,
                                  errorBorder: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(25.0),
                                      borderSide: BorderSide(
                                          color: Colors.red, width: 2)),
                                  focusedBorder: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(25.0),
                                    borderSide: BorderSide(
                                        color: kPrimaryColor, width: 2),
                                  ),
                                  enabledBorder: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(25.0),
                                    borderSide: BorderSide(
                                      color: kPrimaryLightColor,
                                      width: 2,
                                    ),
                                  ),
                                  hintText: "Password"),
                              validator: (var value) {
                                if (value!.isEmpty) {
                                  return "Enter Your Password";
                                }
                                return null;
                              },
                              onChanged: (password) {
                                t_password = password;
                              },
                              onSaved: (var password) {
                                t_password = password;
                              },
                            ),
                          ),
                          Column(
                            children: [
                              Container(
                                width: size.width * 0.8,
                                margin: EdgeInsets.only(
                                    left: 10, right: 10, top: 10, bottom: 5),
                                child: ElevatedButton(
                                  style: ElevatedButton.styleFrom(
                                      shape: StadiumBorder(),
                                      padding: EdgeInsets.symmetric(
                                          horizontal: 40, vertical: 15),
                                      backgroundColor: kPrimaryColor),
                                  onPressed: () {
                                    //simple navigation without validation
                                    Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) =>
                                                HospitalStaffHome()));
                                  },
                                  child: Text(
                                    'Login',
                                    style: TextStyle(
                                        color: Colors.white,
                                        fontSize: 18,
                                        fontWeight: FontWeight.w500),
                                  ),
                                ),
                              ),
                              TextButton(
                                onPressed: () {
                                  // Handle forgot password logic here
                                },
                                child: Text(
                                  "Forget Password ?",
                                  style: TextStyle(
                                      color: kPrimaryColor,
                                      fontSize: 14,
                                      fontWeight: FontWeight.w600),
                                ),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Container(
                                height: 2,
                                width: 150,
                                color: kPrimaryLightColor,
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              // ************************************
                              // add new account
                              //*************************************
                              Container(
                                child: Center(
                                  child: Row(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.center,
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Center(
                                        child: Text(
                                          "Don't have an account?",
                                          style: TextStyle(
                                              color: Colors.black26,
                                              fontSize: 14),
                                        ),
                                      ),
                                      TextButton(
                                        onPressed: () {
                                          // Handle create new account logic here
                                        },
                                        child: Text(
                                          " Create New Account",
                                          style: TextStyle(
                                              color: kPrimaryColor,
                                              fontSize: 14,
                                              fontWeight: FontWeight.w600),
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              )
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
        ),
      ),
    );
  }
}
