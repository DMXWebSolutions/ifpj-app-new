import React from 'react';
import {Icon } from 'react-native-elements'
import { createBottomTabNavigator } from 'react-navigation'
import SendNotificationsScreen from './SendNotificationsScreen'
import GetNotificationsScreen from './GetNotificationsScreen'

export default createBottomTabNavigator({

    GetNotifications: { 
      screen: GetNotificationsScreen,
      navigationOptions: () => ({
        title: 'Visualizar Notificações',
        tabBarIcon: ({tintColor}) => (
          <Icon
            type='ionicon'
            name="md-notifications"
            color={tintColor}
          />
        )
      })
    },
    SendNotifications: { 
        screen: SendNotificationsScreen,
        navigationOptions: () => ({
          title: 'Enviar Notificação',
          tabBarIcon: ({tintColor}) => (
            <Icon
              type='ionicon'
              name="md-notifications"
              color={tintColor}
            />
          )
        })
    },
  },
  {
    initialRouteName: 'GetNotifications',
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
