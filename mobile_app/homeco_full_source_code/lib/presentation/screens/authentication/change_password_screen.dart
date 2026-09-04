
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:real_estate/logic/cubit/change_password/change_password_cubit.dart';
import 'package:real_estate/presentation/widget/custom_app_bar.dart';
import 'package:real_estate/presentation/widget/custom_test_style.dart';

import '../../router/route_names.dart';
import '../../utils/utils.dart';
import '../../widget/custom_form.dart';
import '../../widget/fetch_text_error.dart';
import '../../widget/primary_button.dart';


class NewPasswordScreen extends StatelessWidget {
  const NewPasswordScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    final fCubit = context.read<ChangePasswordCubit>();
    return Scaffold(
      appBar: CustomAppBar(title: "Change Password"),
      body: ListView(
        padding: Utils.symmetric(),
        children: [
          Utils.verticalSpace(size.height * 0.06),
          const CustomTextStyle(
            text: "Create New Password",
            fontSize: 24,
            fontWeight: FontWeight.w500,
          ),
          Utils.verticalSpace(16.0),
          BlocBuilder<ChangePasswordCubit, ChangePasswordStateModel>(
            builder: (context, state) {
              final p = state.status;
              return Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  CustomForm(
                    label: "Current Password",
                    child: TextFormField(
                      keyboardType: TextInputType.visiblePassword,
                      initialValue: state.currentPassword,
                      decoration: InputDecoration(
                        hintText: 'password',
                        suffixIcon: IconButton(
                          icon: Icon(
                            state.showOldPassword
                                ? Icons.visibility_off_outlined
                                : Icons.visibility_outlined,
                            color: Colors.grey,
                          ),
                          onPressed: () => fCubit.showOldPassword(),
                        ),
                      ),

                      obscureText: state.showOldPassword,
                      onChanged: fCubit.currentPassChange,
                    ),
                  ),
                  if (p is ChangePasswordFormValidateError)
                    if (p.errors.currentPassword.isNotEmpty)
                      FetchErrorText(text: p.errors.currentPassword.first),
                ],
              );
            },
          ),
          Utils.verticalSpace(10.0),
          BlocBuilder<ChangePasswordCubit, ChangePasswordStateModel>(
            builder: (context, state) {
              final p = state.status;
              return Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  CustomForm(
                    label: "New Password",
                    child: TextFormField(
                      keyboardType: TextInputType.visiblePassword,
                      initialValue: state.password,
                      obscureText: state.showPassword,
                      onChanged: fCubit.passwordChange,
                      decoration: InputDecoration(
                        hintText: 'password',
                        suffixIcon: IconButton(
                          icon: Icon(
                            state.showPassword
                                ? Icons.visibility_off_outlined
                                : Icons.visibility_outlined,
                            color: Colors.grey,
                          ),
                          onPressed: () => fCubit.showPassword(),
                        ),
                      ),

                    ),
                  ),
                  if (p is ChangePasswordFormValidateError)
                    if (p.errors.password.isNotEmpty)
                      FetchErrorText(text: p.errors.password.first),
                ],
              );
            },
          ),
          Utils.verticalSpace(10.0),
          BlocBuilder<ChangePasswordCubit, ChangePasswordStateModel>(
            builder: (context, state) {
              final p = state.status;
              return Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  CustomForm(
                    label: "Confirm New Password",
                    child: TextFormField(
                      keyboardType: TextInputType.visiblePassword,
                      initialValue: state.passwordConfirmation,
                      decoration: InputDecoration(
                        hintText: 'password',
                        suffixIcon: IconButton(
                          icon: Icon(
                            state.showConfirmPassword
                                ? Icons.visibility_off_outlined
                                : Icons.visibility_outlined,
                            color: Colors.grey,
                          ),
                          onPressed: () => fCubit.showConfirmPassword(),
                        ),
                      ),

                      obscureText: state.showConfirmPassword,
                      onChanged: fCubit.passwordConfirmChange,
                    ),
                  ),
                  if (p is ChangePasswordFormValidateError)
                    if (p.errors.passwordConfirmation.isNotEmpty)
                      FetchErrorText(text: p.errors.passwordConfirmation.first),
                ],
              );
            },
          ),


          Utils.verticalSpace(30.0),
          BlocListener<ChangePasswordCubit, ChangePasswordStateModel>(
            listener: (context, state) {
              final reg = state.status;
              if (reg is ChangePasswordStateLoading) {
                Utils.loadingDialog(context);
              } else {
                Utils.closeDialog(context);
                if (reg is ChangePasswordStateError) {
                  Utils.errorSnackBar(context,reg.message);
                } else if (reg is ChangePasswordStateLoaded) {
                  Utils.showSnackBar(context, reg.mesage);
                  Navigator.pop(context);
                  // Navigator.pushNamedAndRemoveUntil(
                  //     context, RouteNames.homeScreen, (route) => false);

                }
              }
            },
            child: PrimaryButton(
                text: "Create New",
                onPressed: () {
                  fCubit.submitForm();
                }),
          ),
        ],
      ),
    );
  }
}
