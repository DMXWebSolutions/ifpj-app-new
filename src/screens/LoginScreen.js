import React, { Component } from 'react';
import {  StyleSheet, View, TextInput, Alert, AsyncStorage, Image } from 'react-native';
import api from '../services/api';
import { Container, Content, Input, Item, Icon, Button, Text, Label, Toast } from 'native-base';
import { Root } from "native-base";

export default class LoginScreen extends Component {
    constructor(props) {
        super(props);
        this.state = {
            register: '',
            password: '',
            loggedInUser: null,
            errorMessage: '',
            showToast: false
        }
    }

    onChangeHandler(field, value) {
        this.setState({
            [field] : value
        });
    }

    toastMessage = (errorMessage) => {
        Toast.show({
        text: errorMessage,
        position: "top",
        buttonText: "Okay",
        buttonTextStyle: { color: "#333" },
        buttonStyle: { backgroundColor: "#edd134" },
        duration: 20000,
    })}

    profileVerify = (userProfile) => {
        if(userProfile === 'ALUNO'){
            console.log('logado com aluno')
            return this.props.navigation.navigate('Student');
        }
        if(userProfile === 'PROFESSOR') {
            console.log('logado com professor')
            return this.props.navigation.navigate('Teacher');
        }
    }

    signIn = async(register, password) => {
        try{
            const {register, password} = this.state
            const response = await api.post('/authenticate',{ register, password})
            const { token, user } = response.data;
            await AsyncStorage.multiSet([
                ['@CodeApi:token', token],
                ['@CodeApi:user', JSON.stringify(user)]
            ]);
            this.setState({ loggedInUser: user});
            this.profileVerify(user.profiles)
        } catch (response) {   
            this.setState({ errorMessage: response.data.error, showToast: true})
            this.toastMessage(this.state.errorMessage)
        }
    }

    render() {
        return (
            <Root>
                <Container style={styles.container}>
                    <View style={styles.logoContent}>
                        <Image
                            source={require('../assets/imgs/logo.png')} 
                            style={styles.logo}   
                        />    
                    </View>
                    <Content>
                        <Item regular style={styles.form}>
                            <Icon active name='md-person' />
                            <Input 
                                placeholder='Usuario' 
                                value={this.state.register}
                                onChangeText={ value => this.onChangeHandler('register',value)}/>
                        </Item>
                        <Item regular style={styles.form}>
                            <Icon active name='md-lock' />
                            <Input 
                                placeholder='Senha' 
                                style={styles.input} 
                                secureTextEntry
                                value={this.state.password}
                                onChangeText={value => this.onChangeHandler('password' ,value)}
                            />
                        </Item>
                        <Button full style={styles.button} onPress={this.signIn}   title="Entrar" >
                            <Text style={styles.textButton}>Entrar</Text>
                        </Button>
                    </Content>
                </Container>
            </Root>   
        )
    }
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: '#4b86fc',
        alignItems: 'center',
    },
    logoContent: {
        backgroundColor: '#fff',
        width: '100%',
        height: 200,
        justifyContent: 'center',
        alignItems: 'center',
        marginBottom: 30,
    },
    itemButton: {
    },
    input: {
    },
    button: {
        marginTop: 5,
        backgroundColor: '#edd134',
        justifyContent: 'center',
    },
    textButton: {
        color: '#333'
    },
    form: {
        width: 330,
        marginBottom: 10,
        height: 50,
        backgroundColor: 'white'
    }
});