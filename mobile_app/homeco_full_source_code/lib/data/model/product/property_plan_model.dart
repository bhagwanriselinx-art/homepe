import 'dart:convert';

import 'package:equatable/equatable.dart';

import '../../../logic/cubit/home/cubit/property_details_cubit.dart';

class PropertyPlan extends Equatable {
  final int id;
  final int propertyId;
  final String title;
  final String description;
  final String image;
  final String createdAt;
  final String updatedAt;
  final PropertyDetailsState detailsState;

  const PropertyPlan({
    this.id = 0,
    this.propertyId = 0,
    this.title = '',
    this.description = '',
    this.image = '',
    this.createdAt = '',
    this.updatedAt = '',
    this.detailsState = const PropertyDetailsInitial(),
  });

  PropertyPlan copyWith({
    int? id,
    int? propertyId,
    String? title,
    String? description,
    String? image,
    String? createdAt,
    String? updatedAt,
    PropertyDetailsState? detailsState,
  }) {
    return PropertyPlan(
      id: id ?? this.id,
      propertyId: propertyId ?? this.propertyId,
      title: title ?? this.title,
      description: description ?? this.description,
      image: image ?? this.image,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
      detailsState: detailsState ?? this.detailsState,
    );
  }

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'propertyId': propertyId,
      'title': title,
      'description': description,
      'image': image,
      'createdAt': createdAt,
      'updatedAt': updatedAt,
    };
  }

  factory PropertyPlan.fromMap(Map<String, dynamic> map) {
    return PropertyPlan(
      id: map['id'] ?? 0,
      propertyId: map['property_id'] != null ? int.parse(map['property_id'].toString()) : 0,
      title: map['title'] ?? '',
      description: map['description'] ?? '',
      image: map['image'] ?? '',
      createdAt: map['created_at'] ?? '',
      updatedAt: map['updated_at'] ?? '',
    );
  }

  String toJson() => json.encode(toMap());

  factory PropertyPlan.fromJson(String source) =>
      PropertyPlan.fromMap(json.decode(source) as Map<String, dynamic>);

  @override
  bool get stringify => true;

  @override
  List<Object> get props {
    return [
      id,
      propertyId,
      title,
      description,
      image,
      createdAt,
      updatedAt,
      detailsState,
    ];
  }
}
