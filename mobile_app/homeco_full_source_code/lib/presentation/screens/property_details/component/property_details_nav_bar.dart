import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import '../../../../data/model/product/property_plan_model.dart';
import '/logic/cubit/booking/booking_cubit.dart';
import 'package:url_launcher/url_launcher.dart';

import '../../../../data/data_provider/remote_url.dart';
import '../../../../logic/bloc/login/login_bloc.dart';
import '../../../../logic/cubit/home/cubit/property_details_cubit.dart';
import '../../../router/route_names.dart';
import '../../../utils/constraints.dart';
import '../../../utils/k_images.dart';
import '../../../utils/utils.dart';
import '../../../widget/custom_images.dart';
import '../../../widget/custom_test_style.dart';
import '../../../widget/primary_button.dart';

class PropertyDetailNavBar extends StatefulWidget {
  const PropertyDetailNavBar({super.key});

  @override
  State<PropertyDetailNavBar> createState() => _PropertyDetailNavBarState();
}

class _PropertyDetailNavBarState extends State<PropertyDetailNavBar> {
  bool _isExpanded = false;

  @override
  Widget build(BuildContext context) {
    final loginBloc = context.read<LoginBloc>();

    void getErrorMessage() {
      return Utils.showSnackBar(context, Utils.translatedText(context, 'WhatsApp is not installed yet!'));
    }

    return BlocBuilder<PropertyDetailsCubit, PropertyPlan>(
      builder: (context, detail) {
        final state = detail.detailsState;
        if (state is PropertyDetailsLoaded) {
          final agent = state.singlePropertyModel.propertyAgent;
          return AnimatedContainer(
            duration: const Duration(milliseconds: 1000), // Smooth height transition
            width: Utils.mediaQuery(context).width,
            padding: const EdgeInsets.only(bottom: 5.0),
            decoration: BoxDecoration(
              color: primaryColor,
              borderRadius: const BorderRadius.only(
                topRight: Radius.circular(20.0),
                topLeft: Radius.circular(20.0),
              ),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisSize: MainAxisSize.min,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Padding(
                  padding: Utils.symmetric(h: 20.0, v: 16.0),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      ClipOval(
                        child: CustomImage(
                          path: RemoteUrls.imageUrl(agent?.image ?? ''),
                          height: Utils.mediaQuery(context).height * 0.08,
                          width: Utils.mediaQuery(context).height * 0.08,
                          fit: BoxFit.cover,
                        ),
                      ),
                      const SizedBox(width: 10.0),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Row(
                              children: [
                                Flexible(
                                  child: CustomTextStyle(
                                    text: agent?.name ?? '',
                                    fontSize: 20.0,
                                    maxLine: 1,
                                    fontWeight: FontWeight.w600,
                                    color: whiteColor,
                                  ),
                                ),
                                Utils.horizontalSpace(agent?.kycStatus == 1 ? 4.0 : 0),
                                if (agent?.kycStatus == 1) ...[
                                  const Icon(
                                    Icons.verified_rounded,
                                    color: Color(0xFF01BF8B),
                                    size: 18.0,
                                  )
                                ],
                              ],
                            ),
                            CustomTextStyle(
                              text: agent?.designation ?? '',
                              fontSize: 14.0,
                              fontWeight: FontWeight.w400,
                              color: whiteColor,
                            ),
                          ],
                        ),
                      ),
                      GestureDetector(
                        onTap: () {
                          setState(() {
                            _isExpanded = !_isExpanded;
                          });
                        },
                        child: CircleAvatar(
                          backgroundColor: yellowColor,
                          child: Icon(
                            _isExpanded ? Icons.remove : Icons.add,
                            color: blackColor,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                if (_isExpanded)
                  Column(
                    children: [
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                        children: [
                          GestureDetector(
                            onTap: () {
                              if (loginBloc.userInfo?.accessToken.isNotEmpty ?? false) {
                                Navigator.pushNamed(context, RouteNames.sendMessageScreen, arguments: agent?.email ?? '');
                              } else {
                                Utils.showSnackBarWithLogin(context);
                              }
                            },
                            child: Container(
                              decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(8.0),
                                  color: whiteColor),
                              child: Padding(
                                padding: Utils.symmetric(h: 30.0, v: 10.0),
                                child: Row(
                                  children: [
                                    const CustomImage(path: KImages.messageIcon),
                                    Utils.horizontalSpace(8.0),
                                    CustomTextStyle(
                                      text: Utils.translatedText(context, 'Message'),
                                      fontSize: 16.0,
                                      fontWeight: FontWeight.w500,
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          ),
                          GestureDetector(
                            onTap: () async {
                              if (loginBloc.userInfo?.accessToken.isNotEmpty ?? false) {
                                final android = "whatsapp://send?phone=${agent?.phone}&text=${Utils.translatedText(context, 'Hello')}, ${agent?.name} ";
                                final ios = "https://wa.me/${agent?.phone}?text=${Uri.parse(Utils.translatedText(context, 'Hello, I need your help'))}";
                                final androidUrl = Uri.parse(android);
                                final iosUrl = Uri.parse(ios);
                                try {
                                  if (agent?.phone.isNotEmpty ?? false) {
                                    if (Platform.isIOS) {
                                      await launchUrl(iosUrl, mode: LaunchMode.externalApplication);
                                    } else {
                                      await launchUrl(androidUrl, mode: LaunchMode.externalApplication);
                                    }
                                  } else {
                                    Utils.showSnackBar(context, Utils.translatedText(context, 'Phone number is not available'));
                                  }
                                } catch (e) {
                                  getErrorMessage();
                                }
                              } else {
                                Utils.showSnackBarWithLogin(context);
                              }
                            },
                            child: Container(
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(8.0),
                                color: const Color(0xff00bc14),
                              ),
                              child: Padding(
                                padding: Utils.symmetric(h: 30.0, v: 10.0),
                                child: Row(
                                  children: [
                                    const CustomImage(path: KImages.whatsAppIcon, color: whiteColor, height: 20),
                                    Utils.horizontalSpace(8.0),
                                    CustomTextStyle(
                                      text: Utils.translatedText(context, "Whats App"),
                                      fontSize: 16.0,
                                      fontWeight: FontWeight.w500,
                                      color: whiteColor,
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          ),
                        ],
                      ),
                      Utils.verticalSpace(10.0),
                      Padding(
                        padding: Utils.symmetric(h: 16.0, v: 10.0),
                        child: PrimaryButton(
                          bgColor: yellowColor,
                          textColor: blackColor,
                          text: Utils.translatedText(context, 'Book Now'),
                          onPressed: () {
                            if (loginBloc.userInfo?.accessToken.isNotEmpty ?? false) {
                              context.read<BookingCubit>().clear();
                              Navigator.pushNamed(context, RouteNames.createBookingScreen);
                            } else {
                              Utils.showSnackBarWithLogin(context);
                            }
                          },
                        ),
                      ),
                    ],
                  ),
              ],
            ),
          );
        }
        return const SizedBox.shrink();
      },
    );
  }
}

