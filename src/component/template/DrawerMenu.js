import React from 'react'
import { createDrawerNavigator } from 'react-navigation'

import MainScreen from '../../screens/MainScreen'
import TeacherScreen from '../../screens/TeacherScreen'
import GradesScreen from '../../screens/GradesScreen'
import SideBar from '../../component/template/SideBar'

export const DrawerMenu = createDrawerNavigator({

    Main: { screen: MainScreen},
    Teacher: { screen: TeacherScreen},
    Grades: { screen: GradesScreen},
},
    {
        initialRouteName: 'Main',
        contentComponent: SideBar
    }
) 

// const Drawer = createDrawerNavigator({
//     Login: { 
//         screen: LoginScreen,
//         navigationOptions: {
//             drawerLockMode: 'locked-closed'
//         }
//     },
//     Main: { screen: MainScreen},
//     Grades: { screen: GradesScreen},
// },
//     {
//         initialRouteName: 'Login',
//         contentComponent: SideBar
//     }
// )