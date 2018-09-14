import React from 'react';
import { Container } from 'native-base'
import HeaderMenu from '../component/template/HeaderMenu'
import { createBottomTabNavigator } from 'react-navigation'
import { Icon } from 'react-native-elements'
import DisciplineScreen from './DisciplineScreen';
import NotificationsScreen from './NotificationsScreen'
import Notices from '../component/notices/Notices'


class HomeScreen extends React.Component {

  render() {
    return ( 
      <Container>
        <HeaderMenu title='Home'/>
        <Notices/>
      </Container>
    );
  }
}

class DisciplinesScreen extends React.Component {
  render() {
    return (
      <Container>
        <HeaderMenu title='Boletim'/>
        <DisciplineScreen/>
      </Container>
    );
  }
}
class NotificationScreen extends React.Component {
  render() {
    return (
      <Container>
        <HeaderMenu title='Comunicados'/>
        <NotificationsScreen/> 
      </Container>
    );
  }
}

export default createBottomTabNavigator({

    // Home: { 
    //   screen: HomeScreen,
    //   navigationOptions: () => ({

    //     inactiveTintColor: '#777',
    //     tabBarIcon: ({tintColor}) => (
    //       <Icon
    //         type='ionicon'
    //         name="md-home"
    //         color={tintColor}

    //       />
    //     )
    //   })
    // },
    // Comunicados: { 
    //   screen: NotificationScreen,
    //   navigationOptions: () => ({
    //     tabBarIcon: ({tintColor}) => (
    //       <Icon
    //         type='ionicon'
    //         name="md-notifications"
    //         color={tintColor}
    //       />
    //     )
    //   })
    // },
    Boletim: { 
      screen: DisciplinesScreen,
      navigationOptions: () => ({
        tabBarIcon: ({tintColor}) => (
          <Icon
            type='ionicon'
            name="md-school"
            color={tintColor}
          />
        )
      })
    }
  },
  {
    tabBarOptions: {
      
      activeTintColor: '#68c8f2',
      inactiveTintColor: '#444444',
      labelStyle: {
        fontSize: 12,
      },
      style: {
        backgroundColor: '#f5f5f5'
      }
    },
    animationEnabled: false,
    swipeEnabled: false,
  }
);
