import 'package:equatable/equatable.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter/material.dart';

import '../../../data/model/auth/auth_error_model.dart';
import '../../../presentation/error/failure.dart';
import '../../bloc/login/login_bloc.dart';
import '../../repository/profile_repository.dart';

part 'change_password_state.dart';

class ChangePasswordCubit extends Cubit<ChangePasswordStateModel> {
  ChangePasswordCubit({
    required ProfileRepository profileRepository,
    required LoginBloc loginBloc,
  })  : _profileRepository = profileRepository,
        _loginBloc = loginBloc,
        super(ChangePasswordStateModel.init());

  final ProfileRepository _profileRepository;
  final LoginBloc _loginBloc;

  final formKey = GlobalKey<FormState>();
  final currentPassCtr = TextEditingController();
  final passCtr = TextEditingController();
  final passConfCtr = TextEditingController();

  void currentPassChange(String value) {
    emit(state.copyWith(
      currentPassword: value,
      status: const ChangePasswordStateInitial(),
    ));
  }

  void passwordChange(String value) {
    emit(state.copyWith(
      password: value,
      status: const ChangePasswordStateInitial(),
    ));
  }

  void passwordConfirmChange(String value) {
    emit(state.copyWith(
      passwordConfirmation: value,
      status: const ChangePasswordStateInitial(),
    ));
  }

  void showPassword() {
    emit(state.copyWith(
        showPassword: !state.showPassword,
        status: const ChangePasswordStateInitial()));
  }

  void showOldPassword() {
    emit(state.copyWith(
        showOldPassword: !state.showOldPassword,
        status: const ChangePasswordStateInitial()));
  }

  void showConfirmPassword() {
    emit(state.copyWith(
        showConfirmPassword: !state.showConfirmPassword,
        status: const ChangePasswordStateInitial()));
  }

  Future<void> submitForm() async {
    if (_loginBloc.userInfo == null) {
      emit(state.copyWith(
          status: const ChangePasswordStateError('Signin please', 10000)));
      return;
    }


    emit(state.copyWith(status: const ChangePasswordStateLoading()));

    final token = _loginBloc.userInfo!.accessToken;

    final result = await _profileRepository.passwordChange(state, token);

    result.fold(
          (failure) {
        if (failure is InvalidAuthData) {
          final errors = ChangePasswordFormValidateError(failure.errors);
          emit(state.copyWith(status: errors));
        } else {
          final errors =
          ChangePasswordStateError(failure.message, failure.statusCode);
          emit(state.copyWith(status: errors));
        }
      },
          (data) {
        emit(state.copyWith(status: ChangePasswordStateLoaded(data)));
      },
    );
  }
}
