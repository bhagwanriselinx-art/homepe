import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:real_estate/presentation/screens/home/component/search_field.dart';

import '../../../../logic/cubit/agency/agency_cubit.dart';
import '../../../utils/utils.dart';
import '../agent/components/agent_tab_info.dart';
import '/logic/cubit/agent/agent_cubit.dart';
import '/presentation/widget/custom_test_style.dart';
import '/presentation/widget/loading_widget.dart';
import '../../../../data/model/auth/user_profile_model.dart';
import '../../../../logic/cubit/agent/agent_state_model.dart';
import '../../../../presentation/utils/constraints.dart';
import '../../../../presentation/widget/custom_app_bar.dart';
import '../../../widget/page_refresh.dart';
import 'agent_search.dart';
import 'single_broker_agent_card_view.dart';

class AllBrokerAgentListScreen extends StatefulWidget {
  const AllBrokerAgentListScreen({super.key});

  @override
  State<AllBrokerAgentListScreen> createState() => _AllBrokerAgentListScreenState();
}

class _AllBrokerAgentListScreenState extends State<AllBrokerAgentListScreen> {
  late AgentCubit agentListCubit;
  late AgencyCubit agencyCubit;

  @override
  void initState() {
    agentListCubit = context.read<AgentCubit>();
    agencyCubit = context.read<AgencyCubit>();
    agencyCubit.addCallAPI(true);
    Future.microtask(()=>agentListCubit.getAllAgent());
    super.initState();
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: scaffoldBackground,
      appBar: CustomAppBar(
        title: agentListCubit.agents?.seoSetting?.pageName ?? 'All Broker Agent',
      ),
      body: PageRefresh(
        onRefresh: () async => agentListCubit.getAllAgent(),
        child: BlocBuilder<AgentCubit, AgentStateModel>(
          builder: (context, state) {
            final agent = state.agentState;
            if (agent is AgentLoading) {
              return const LoadingWidget();
            } else if (agent is AgentError) {
              if (agent.statusCode == 503) {
                return LoadedAgentList(agents: agentListCubit.agents?.agents??[]);
              } else {
                return Center(
                  child: CustomTextStyle(
                    text: agent.message,
                    color: redColor,
                  ),
                );
              }
            }

            // else if (state is AgentListLoaded) {
            //   return LoadedAgentList(agents: state.agents.agents!);
            // }
            return LoadedAgentList(agents: agentListCubit.agents?.agents??[]);
          },
        ),
      ),
    );
  }

}


class LoadedAgentList extends StatelessWidget {
  const LoadedAgentList({super.key, required this.agents});

  final List<UserProfileModel> agents;

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        children: [
          AgentTabInfo(agents: agents),
        ],
      ),
    );
  }
}

class AgentListScreen extends StatefulWidget {
  const AgentListScreen({super.key, required this.agents});

  final List<UserProfileModel> agents;

  @override
  _AgentListScreenState createState() => _AgentListScreenState();
}

class _AgentListScreenState extends State<AgentListScreen> {
  String _searchQuery = ''; // To track the current search query
  late List<UserProfileModel> _filteredAgents; // To store filtered agents

  @override
  void initState() {
    super.initState();
    _filteredAgents = widget.agents; // Initially, all agents are shown
  }

  // Method to filter the agents based on the search query
  void _onSearchChanged(String query) {
    setState(() {
      _searchQuery = query.toLowerCase();
      _filteredAgents = widget.agents
          .where((agent) => agent.name.toLowerCase().contains(_searchQuery))
          .toList();
    });
  }

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        children: [
          // AgentSearch widget with the onSearchChanged callback
          AgentSearch(onSearchChanged: _onSearchChanged,),
          SizedBox(
            height: 595,
            child: _filteredAgents.isEmpty
                ? const Center(child: Text('No agents found'))
                : SingleChildScrollView(
                  padding: Utils.only(bottom: Utils.mediaQuery(context).height * 0.1),
                        child: SizedBox(
                          width: Utils.mediaQuery(context).width,
                          child: Wrap(
                            runSpacing: 10.0,
                            spacing: 10.0,
                            alignment: WrapAlignment.center,
                            runAlignment: WrapAlignment.center,
                            children: [
                              ...List.generate(_filteredAgents.length, (index) {
                                return SingleBrokerAgentCartView(
                                    agent: _filteredAgents[index],
                                    width: Utils.mediaQuery(context).width * 0.44
                                );
                              }),
                              if(_filteredAgents.length % 2 == 1)...[
                                SizedBox(width: Utils.mediaQuery(context).width * 0.44)
                              ]
                            ],
                          ),
                        ),
                  ),
          ),
        ],
      ),
    );
  }
}


