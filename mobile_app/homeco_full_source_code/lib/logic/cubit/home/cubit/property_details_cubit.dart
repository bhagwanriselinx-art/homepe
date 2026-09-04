import 'package:equatable/equatable.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../../../../data/model/product/property_plan_model.dart';
import '../../../../data/model/product/single_property_model.dart';
import '../../../repository/home_repository.dart';

part 'property_details_state.dart';

class PropertyDetailsCubit extends Cubit<PropertyPlan> {
  final HomeRepository _homeRepository;

  PropertyDetailsCubit(HomeRepository homeRepository)
      : _homeRepository = homeRepository,
        super(PropertyPlan());

  SinglePropertyModel? singleProperty;

  void currentTab(int index)=>emit(state.copyWith(id: index));

  Future<void> fetchPropertyDetails(String slug) async {
    final loading = PropertyDetailsLoading();
    emit(state.copyWith(detailsState: loading));

    final result = await _homeRepository.getSingleProperty(slug);
    result.fold(
      (failuer) {
        final loading = PropertyDetailsError(failuer.message, failuer.statusCode);
        emit(state.copyWith(detailsState: loading));
      },
      (data) {
        singleProperty = data;
        final loading = PropertyDetailsLoaded(data);
        emit(state.copyWith(detailsState: loading));
      },
    );
  }
}
