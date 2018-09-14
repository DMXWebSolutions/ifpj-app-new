import React, { Component } from 'react';
import { Container, Content, Text } from 'native-base'
import HeaderMenu from '../component/template/HeaderMenu'

export default class  extends Component {
    state = {  }
    render() {
        return (
            <Container>
                <HeaderMenu title='Visualizar Notificações'/>
                <Text>Ver Notificações</Text>
            </Container>
        );
    }
}