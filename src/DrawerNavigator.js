import { createDrawerNavigator } from 'react-navigation'
import TeacherScreen from './screens/TeacherScreen'
import StudentScreen from './screens/StudentScreen'
import LoginScreen from './screens/LoginScreen'
import SideBar from './component/template/SideBar'

export default createDrawerNavigator({
    Login:{ screen: LoginScreen},
    Teacher:{ screen: TeacherScreen},
    Student:{ screen: StudentScreen},
} ,{
    contentComponent: SideBar
})