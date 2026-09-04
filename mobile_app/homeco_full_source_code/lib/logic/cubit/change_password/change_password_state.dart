part of 'change_password_cubit.dart';

class ChangePasswordStateModel extends Equatable {
  final String currentPassword;
  final String password;
  final String passwordConfirmation;
  final bool showPassword;
  final bool showOldPassword;
  final bool showConfirmPassword;
  final ChangePasswordState status;
  const ChangePasswordStateModel({
   this.currentPassword = '',
     this.password = '',
     this.passwordConfirmation = '',
    this.showPassword = true,
    this.showOldPassword = true,
    this.showConfirmPassword = true,
     this.status = const ChangePasswordStateInitial(),
  });
  factory ChangePasswordStateModel.init() {
    return const ChangePasswordStateModel(
      currentPassword: '',
      password: '',
      passwordConfirmation: '',
      showPassword: true,
      showOldPassword: true,
      showConfirmPassword: true,
      status: ChangePasswordStateInitial(),
    );
  }

  ChangePasswordStateModel copyWith({
    String? currentPassword,
    String? password,
    String? passwordConfirmation,
    bool? showPassword,
    bool? showOldPassword,
    bool? showConfirmPassword,
    ChangePasswordState? status,
  }) {
    return ChangePasswordStateModel(
      currentPassword: currentPassword ?? this.currentPassword,
      password: password ?? this.password,
      passwordConfirmation: passwordConfirmation ?? this.passwordConfirmation,
      showPassword: showPassword ?? this.showPassword,
      showOldPassword: showOldPassword ?? this.showOldPassword,
      showConfirmPassword: showConfirmPassword ?? this.showConfirmPassword,
      status: status ?? this.status,
    );
  }

  Map<String, dynamic> toMap() {
    final result = <String, dynamic>{};

    result.addAll({'current_password': currentPassword});
    result.addAll({'password': password});
    result.addAll({'password_confirmation': passwordConfirmation});

    return result;
  }

  @override
  String toString() {
    return 'ChangePasswordStateModel(currentPassword: $currentPassword, password: $password, passwordConfirmation: $passwordConfirmation, status: $status, )';
  }

  @override
  List<Object> get props =>
      [currentPassword, password, passwordConfirmation,showPassword,
        showConfirmPassword,
        showOldPassword, status];
}

abstract class ChangePasswordState extends Equatable {
  const ChangePasswordState();

  @override
  List<Object> get props => [];
}

class ChangePasswordStateInitial extends ChangePasswordState {
  const ChangePasswordStateInitial();
}

class ChangePasswordStateLoading extends ChangePasswordState {
  const ChangePasswordStateLoading();
}

class ChangePasswordStateLoaded extends ChangePasswordState {
  final String mesage;
  const ChangePasswordStateLoaded(this.mesage);
  @override
  List<Object> get props => [mesage];
}

class ChangePasswordStateError extends ChangePasswordState {
  final String message;
  final int statusCode;
  const ChangePasswordStateError(this.message, this.statusCode);
  @override
  List<Object> get props => [message, statusCode];
}

class ChangePasswordFormValidateError extends ChangePasswordState {
  const ChangePasswordFormValidateError(this.errors);

  final Errors errors;

  @override
  List<Object> get props => [errors];
}
