import { createStackNavigator } from 'react-navigation'
import LoginScreen from './screens/LoginScreen';
import GradesScreen from './screens/GradesScreen'
import DrawerNavigation from './DrawerNavigator'

const Navigators = createStackNavigator({
    Login: { 
        screen: LoginScreen,
        navigationOptions: {
            header: null
        }
    },
    Screens: {
        screen: DrawerNavigation,
        navigationOptions: {
            header: null
        }
    },
    Grades: { 
        screen: GradesScreen,
        navigationOptions: {
            header: null
        }
    },
},
    {
        initialRouteName: 'Login',
    }
)

export { Navigators }