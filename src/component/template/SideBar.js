import React, { Component } from 'react'
import { View, StyleSheet, AsyncStorage } from 'react-native'
import { Avatar, Text, Button } from 'react-native-elements'
import { Content } from 'native-base'

export default class SideBar extends Component {
    constructor(props) {
        super(props)
        this.state = {
            user: ''
        }
    }

    async componentDidMount() {
        const user = JSON.parse(await AsyncStorage.getItem('@CodeApi:user'));
        this.setState({ user })
    }

    async logout() {
        await AsyncStorage.removeItem('@CodeApi:user')
        await AsyncStorage.removeItem('@CodeApi:token')
        this.props.navigation.navigate('Login')
    }

    renderStudentItems() {
        return(
            <View>
                {/* <Button 
                    title='Home'
                    buttonStyle={styles.button}
                    color="#333"
                    fontSize={18}
                    onPress={() => this.props.navigation.navigate('Home')}
                /> */}
            
                <Button
                    title='Boletim' 
                    buttonStyle={styles.button}
                    color="#333"
                    fontSize={18}
                    onPress={() => this.props.navigation.navigate('Boletim')}
                />
                <Button
                    title='Sair' 
                    buttonStyle={styles.button}
                    color="#333"
                    fontSize={18}
                    onPress={ () => this.logout()}
                />
            </View>
        )
    }

    renderTeacherItems() {
        return(
            <View>
                <Button
                    title='Sair' 
                    buttonStyle={styles.button}
                    color="#333"
                    fontSize={18}
                    onPress={ () => this.logout()}
                />
            </View>
        )
    }

    renderAvatar() {
        const { user } = this.state
        const avatarType = user.profiles === 'ALUNO' ? 'A' : 'P'

        return(
            <Avatar
                xlarge
                rounded
                title={avatarType}
                activeOpacity={0.7}
                containerStyle={{flex: 1, marginTop: 20, marginBottom: 5}}
            />
        )
    }

    render(){
        const { user } = this.state

        return(
            <Content style={styles.content}>
                <View style={styles.profile}>
                    { this.renderAvatar() }
                    <Text style={{ textAlign: 'center', fontSize: 20 }}> 
                        {user.name}
                    </Text>
                </View>
                { user.profiles === 'ALUNO'? this.renderStudentItems() : this.renderTeacherItems() }
            </Content>
        )
    }
}

const styles = StyleSheet.create({
    content: {
        backgroundColor: '#fff',
    },
    profile: {
        flex: 1,
        alignItems: 'center',
        marginBottom: 10
    },
    button: {
        marginTop: 8,
        marginBottom: 8,
        backgroundColor: "transparent",
    }
})