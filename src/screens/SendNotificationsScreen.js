import React, { Component } from 'react';
import { StyleSheet, Text, View, AsyncStorage } from 'react-native';
import { Container, Content, Item, Input, Form, Picker, Icon, Textarea, Button, Toast, Root} from 'native-base'
import HeaderMenu from '../component/template/HeaderMenu'
import api from '../services/api';

const initialState = { classroom: '', classes: [], title: '', message: '' }

export default class SendNotificationsScreen extends Component {
    state = { classroom: '', classes: [], title: '', message: '' }

    async componentWillMount() {
        const user = JSON.parse(await AsyncStorage.getItem('@CodeApi:user'));
        this.setState({ user })
        await this.getClassesList()
    }

    async getClassesList() {

        const { user } = this.state
        const response =  await api.get(`/teachers/${user.register}/classrooms`)
        const classes = response.data.classes.map(e => 
            new Object({key: e.codturm, value: e.codturm, text: e.codturm })
        )
        this.setState({ classes })
    }

    toastMessageError = (errorMessage) => {
        Toast.show({
        text: errorMessage,
        position: "top",
        buttonText: "Okay",
        buttonTextStyle: { color: "#333" },
        buttonStyle: { backgroundColor: "#edd134" },
        duration: 20000,
    })}

    toastMessageSuccess = (successMessage) => {
        Toast.show({
        text: successMessage,
        position: "top",
        buttonText: "Okay",
        buttonTextStyle: { color: "#fff" },
        buttonStyle: { backgroundColor: "#42b9f4" },
        duration: 20000,
    })}

    async sendNotification() {
        try {
            const { classroom, title, message, user } = this.state
            const response = await api.post('/notifications/classroom', {
                "register": user.register,
                "title": title,
                "classroom": classroom,
                "message": message
            })
            const msg = 'Notificação Enviada com sucesso'
            this.setState({showToast: true})
            this.toastMessageSuccess(msg)
            this.setState(...initialState)
        } catch (response) {  
            this.setState({showToast: true})
            this.toastMessageError('Erro ao enviar notificação, verifique se todos os campos estão preenchidos')
        }
    }

    onValueChange(value) {
        this.setState({
          classroom: value
        });
    }

    onChangeHandler(field, value) {
        this.setState({
            [field] : value
        });
    }

    renderForm() {
        const { classes } = this.state
        return(
            <Content style={{margin: 10}}>
                <Form style={ styles.formContainer }>
                    <Item picker style={ styles.itemStyle}>
                        <Picker
                            mode="dropdown"
                            iosIcon={<Icon name="ios-arrow-down-outline" />}
                            style={{ width: undefined }}
                            placeholder="Selecione a turma"
                            placeholderStyle={{ color: "#bfc6ea" }}
                            placeholderIconColor="#007aff"
                            selectedValue={this.state.classroom}
                            onValueChange={this.onValueChange.bind(this)}
                        >   
                            <Picker.Item label="Selecione a turma" />
                            {
                                classes.map(item => {
                                    return(
                                        <Picker.Item label={item.text} value={item.value} key={item.key} />
                                    )
                                })
                            }
                            
                        </Picker>
                    </Item>

                    <Item regular style={ styles.itemStyle}>
                        <Input 
                            placeholder='Digite o Titulo' 
                            value={this.state.title}
                            onChangeText={ value => this.onChangeHandler('title',value)}
                        /> 
                    </Item>

                    <Textarea rowSpan={5} bordered 
                        placeholder='Escreva o conteudo da notificação' 
                        value={this.state.message}
                        onChangeText={ value => this.onChangeHandler('message',value)}
                    />

                    <Button info block style={ styles.itemStyle} onPress={() => this.sendNotification()} title="Entrar" >
                        <Text style={{ color: '#fff'}}>Enviar</Text>
                    </Button>
                </Form>
            </Content>

        )
    }

    render(){
        return(
            <Root>
                <Container>
                    <HeaderMenu title='Enviar Notificações'/>
                    { this.renderForm()}
                </Container>
            </Root>
        )
    }
}

const styles = StyleSheet.create({

    formContainer: {
        padding: 10,
    },
    itemStyle: {
        marginTop: 10
    }
})



