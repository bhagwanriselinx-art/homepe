import 'package:flutter/material.dart';
import 'package:real_estate/presentation/widget/custom_test_style.dart';
import '../utils/constraints.dart';
import '../utils/utils.dart';

class CustomForm extends StatelessWidget {
  final String label;
  final Widget child;
  final double bottomSpace;
  final bool requiredField; // Add this

  const CustomForm({
    super.key,
    required this.label,
    required this.child,
    this.bottomSpace = 0.0,
    this.requiredField = false, // Default to false
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            CustomTextStyle(
              text: label,
              fontWeight: FontWeight.w400,
              fontSize: 16.0,
              color: blackColor,
            ),
            if (requiredField)
              const Text(
                ' *',
                style: TextStyle(color: Colors.red, fontSize: 16.0),
              ),
          ],
        ),
        Utils.verticalSpace(6.0),
        child,
        Utils.verticalSpace(bottomSpace),
      ],
    );
  }
}