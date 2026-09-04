import 'package:expandable_page_view/expandable_page_view.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../../../../data/model/product/property_plan_model.dart';
import '../../../../logic/cubit/home/cubit/property_details_cubit.dart';
import '../../../utils/constraints.dart';
import '../../../utils/utils.dart';
import '../../../widget/custom_test_style.dart';
import 'all_tabs/floor_plans_tab.dart';
import 'all_tabs/location_tab.dart';
import 'all_tabs/property_details_tab.dart';
import 'all_tabs/property_video_tab.dart';
import 'all_tabs/review_tab.dart';
///previous code
class PropertyTextTabView extends StatefulWidget {
  const PropertyTextTabView({super.key});

  @override
  State<PropertyTextTabView> createState() => _PropertyTextTabViewState();
}

class _PropertyTextTabViewState extends State<PropertyTextTabView> {
  late PropertyDetailsCubit dCubit;
  late List<String> tabs;
  late List<Widget> pages;
  late PageController _pageController;

  @override
  void initState() {
    super.initState();
    dCubit = context.read<PropertyDetailsCubit>();
    _pageController = PageController();

    tabs = [
      'Property Details',
      'Floor Plans',
      'Property Video',
      'Location',
      'Review',
    ];
    pages = [
      PropertyDetailsTab(),
      const FloorPlansTab(),
      const PropertyVideoTab(),
      const LocationTab(),
      const ReviewTab(),
    ];
  }

  void _onTabSelected(int index) {
    _pageController.jumpToPage(index);
    dCubit.currentTab(index);
  }

  @override
  Widget build(BuildContext context) {
    return BlocBuilder<PropertyDetailsCubit, PropertyPlan>(
      builder: (context, state) {
        return Container(
          color: whiteColor,
          width: Utils.mediaQuery(context).width,
          margin: Utils.symmetric(
              v: Utils.mediaQuery(context).height * 0.03, h: 0.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              SingleChildScrollView(
                scrollDirection: Axis.horizontal,
                physics: const ClampingScrollPhysics(),
                child: Row(
                  children: List.generate(
                    tabs.length,
                        (index) {
                      final active = state.id == index;
                      return GestureDetector(
                        onTap: () => _onTabSelected(index),
                        child: Container(
                          alignment: Alignment.center,
                          padding: const EdgeInsets.symmetric(horizontal: 14.0),
                          margin:
                          const EdgeInsets.only(bottom: 20.0, top: 20.0),
                          decoration: const BoxDecoration(
                            border:
                            Border(bottom: BorderSide(color: borderColor)),
                          ),
                          child: AnimatedContainer(
                            duration: const Duration(milliseconds: 500),
                            curve: Curves.easeInOut,
                            padding: const EdgeInsets.symmetric(
                                horizontal: 10.0, vertical: 14.0),
                            decoration: BoxDecoration(
                              border: Border(
                                bottom: BorderSide(
                                  color: active ? primaryColor : transparent,
                                ),
                              ),
                            ),
                            child: CustomTextStyle(
                              text: tabs[index],
                              fontSize: 16.0,
                              fontWeight: FontWeight.w500,
                              color: active ? blackColor : grayColor,
                            ),
                          ),
                        ),
                      );
                    },
                  ),
                ),
              ),

              ExpandablePageView.builder(
                controller: _pageController,
                itemCount: pages.length,
                onPageChanged: (index) => dCubit.currentTab(index),
                itemBuilder: (context, index) {
                  return Padding(
                    padding: Utils.symmetric(h: 16.0),
                    child: pages[index],
                  );
                },
              ),
            ],
          ),
        );
      },
    );
  }
}

// class PropertyTextTabView extends StatefulWidget {
//   const PropertyTextTabView({super.key});
//
//   @override
//   State<PropertyTextTabView> createState() => _PropertyTextTabViewState();
// }
//
// class _PropertyTextTabViewState extends State<PropertyTextTabView> {
//   late PropertyDetailsCubit dCubit;
//   late List<String> tabs;
//   late List<ScrollableList> pages;
//   late PageController _pageController;
//
//   @override
//   void initState() {
//     super.initState();
//     dCubit = context.read<PropertyDetailsCubit>();
//     _pageController = PageController();
//
//     tabs = [
//       'Property Details',
//       'Floor Plans',
//       'Property Video',
//       'Location',
//       'Review',
//     ];
//     pages = [
//       ScrollableList(
//         label: 'Property Details',
//         body: PropertyDetailsTab()
//       ),
//       ScrollableList(
//           label:'Floor Plans',
//           body: FloorPlansTab()
//       ),
//       ScrollableList(
//           label: 'Property Video',
//           body: PropertyVideoTab()
//       ),
//       ScrollableList(
//           label: 'Location',
//           body: LocationTab()
//       ),
//       ScrollableList(
//           label: 'Review',
//           body: ReviewTab()
//       ),
//     ];
//   }
//
//   void _onTabSelected(int index) {
//     _pageController.jumpToPage(index);
//     dCubit.currentTab(index);
//   }
//
//   @override
//   Widget build(BuildContext context) {
//     return BlocBuilder<PropertyDetailsCubit, PropertyPlan>(
//       builder: (context, state) {
//         return Container(
//           margin: Utils.symmetric(),
//           padding: Utils.only(bottom: Utils.mediaQuery(context).height * 0.4),
//           height: Utils.mediaQuery(context).height,
//           child: ScrollToAnimateTab(
//             // backgroundColor: whiteColor,
//             activeTabDecoration: TabDecoration(
//               decoration: BoxDecoration(
//                 border: Border(
//                   bottom: BorderSide(
//                     color: primaryColor,
//                   ),
//                 ),
//               ),
//               textStyle: TextStyle(
//                 fontSize: 16.0,
//                 fontWeight: FontWeight.w500,
//                 color:  blackColor,
//               ),
//             ),
//             inActiveTabDecoration: TabDecoration(
//               textStyle: TextStyle(
//                 fontSize: 16.0,
//                 fontWeight: FontWeight.w500,
//                 color:  grayColor,
//               ),
//             ),
//             tabs: pages,
//           ),
//         );
//       },
//     );
//   }
//
//   // Container buildContainer(BuildContext context, PropertyPlan state) {
//   //   return Container(
//   //       color: whiteColor,
//   //       width: Utils.mediaQuery(context).width,
//   //       margin: Utils.symmetric(
//   //           v: Utils.mediaQuery(context).height * 0.03, h: 0.0),
//   //       child: Column(
//   //         crossAxisAlignment: CrossAxisAlignment.start,
//   //         children: [
//   //           SingleChildScrollView(
//   //             scrollDirection: Axis.horizontal,
//   //             physics: const ClampingScrollPhysics(),
//   //             child: Row(
//   //               children: List.generate(
//   //                 tabs.length,
//   //                     (index) {
//   //                   final active = state.id == index;
//   //                   return GestureDetector(
//   //                     onTap: () => _onTabSelected(index),
//   //                     child: Container(
//   //                       alignment: Alignment.center,
//   //                       padding: const EdgeInsets.symmetric(horizontal: 14.0),
//   //                       margin:
//   //                       const EdgeInsets.only(bottom: 20.0, top: 20.0),
//   //                       decoration: const BoxDecoration(
//   //                         border:
//   //                         Border(bottom: BorderSide(color: borderColor)),
//   //                       ),
//   //                       child: AnimatedContainer(
//   //                         duration: const Duration(milliseconds: 500),
//   //                         curve: Curves.easeInOut,
//   //                         padding: const EdgeInsets.symmetric(
//   //                             horizontal: 10.0, vertical: 14.0),
//   //                         decoration: BoxDecoration(
//   //                           border: Border(
//   //                             bottom: BorderSide(
//   //                               color: active ? primaryColor : transparent,
//   //                             ),
//   //                           ),
//   //                         ),
//   //                         child: CustomTextStyle(
//   //                           text: tabs[index],
//   //                           fontSize: 16.0,
//   //                           fontWeight: FontWeight.w500,
//   //                           color: active ? blackColor : grayColor,
//   //                         ),
//   //                       ),
//   //                     ),
//   //                   );
//   //                 },
//   //               ),
//   //             ),
//   //           ),
//   //
//   //           ExpandablePageView.builder(
//   //             controller: _pageController,
//   //             itemCount: pages.length,
//   //             onPageChanged: (index) => dCubit.currentTab(index),
//   //             itemBuilder: (context, index) {
//   //               return Padding(
//   //                 padding: Utils.symmetric(h: 16.0),
//   //                 child: pages[index],
//   //               );
//   //             },
//   //           ),
//   //         ],
//   //       ),
//   //     );
//   // }
// }