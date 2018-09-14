import React, { Component } from 'react';
import { StyleSheet} from 'react-native'
import { Container, Header, Content, List, ListItem, Left, Body, Text, Card, CardItem, Button } from 'native-base';
import Modal from 'react-native-modal'
import { Avatar } from 'react-native-elements'
import api from '../services/api';

export default class NotificationsScreen extends Component {
    constructor(props){
        super(props)
        this.state = {
            notifications: [],
            notification: '',
            visibleModal: false,
        }
    }

    async componentWillMount() {
        await this.getUpdateNotifications()
    }

    async getUpdateNotifications() {
        // const user = JSON.parse(await AsyncStorage.getItem('@CodeApi:user'));
        // // const classroom = user.class
        const response = await api.get(`/notifications`)
        const notifications = response.data.notifications.results
        this.setState({ notifications })
    }

    openModal(notification) {
        this.setState({ notification, visibleModal: true })
        this.getUpdateNotifications()
    }

    renderModalContent() {
        const { notification } = this.state
        return(
            <Content>
                <Card>
                    <CardItem header>
                        <Text>{ notification.title }</Text>
                    </CardItem>
                    <CardItem>
                        <Body>
                            <Text>{notification.message}</Text>
                        </Body>
                    </CardItem>
                </Card>
                    <Button bordered block danger onPress={() => this.setState({ visibleModal: false})}>
                        <Text>Fechar</Text>
                    </Button>
            </Content>
        )
    }

    render () {
        const { notifications } = this.state
        return (
            <Container>
                <Content>
                    <Button style={{margin: 10}} info block rounded onPress={() => this.getUpdateNotifications() }>
                        <Text>Atualizar Lista</Text>
                    </Button>
                  
                    <List>
                        {
                            notifications.map((item, i) => {
                                return(
                                    <ListItem avatar key={i} onPress={() => this.openModal(item)}>
                                        <Left>
                                            <Avatar
                                                medium
                                                rounded
                                                title="P"
                                                activeOpacity={0.7}
                                            />
                                        </Left>
                                        <Body>
                                            <Text style={styles.NotificationTitle}>{item.title}</Text>
                                            <Text note>{item.register}</Text>
                                        </Body>
                                    </ListItem>
                                )
                            })
                        }
                    </List>
                </Content>
                <Modal isVisible={this.state.visibleModal}>
                    { this.renderModalContent() }
                </Modal> 
            </Container>
        )
    }
} 

const styles = StyleSheet.create({
    NotificationTitle: {
        fontSize: 18
    },

    ModalContainer: {
        width: 300,
    },

    ModalContentTitle: {
        textAlign: 'center',
        margin: 5,
        fontSize: 24
    }
})