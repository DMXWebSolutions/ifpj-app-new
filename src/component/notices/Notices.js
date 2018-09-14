import React, { Component } from 'react';
import { Image } from 'react-native';
import { Container, Header, View, DeckSwiper, Card, CardItem, Thumbnail, Text, Left, Body, Icon } from 'native-base';
import { Avatar } from 'react-native-elements'

const cards = [
  {
    text: 'Notícia 1',
    name: 'Coordenação',
    image: require('../../assets/imgs/notices/01.jpg'),
    data: '02/08/2018'
  },

  {
    text: 'Notícia 2',
    name: 'Coordenação',
    image: require('../../assets/imgs/notices/02.jpg'),
    data: '09/08/2018'
  },

];

export default class Notices extends Component {
  render() {
    return (
      <Container style={{padding: 10 }}>
        <View>
          <DeckSwiper
            dataSource={cards}
            renderItem={item =>
              <Card style={{ elevation: 3 }}>
                <CardItem>
                  <Left>
                    <Avatar
                      small
                      rounded
                      title="C"
                      activeOpacity={0.7}
                    />
                    <Body>
                      <Text>{item.text}</Text>
                      <Text note>{item.name}</Text>
                    </Body>
                  </Left>
                </CardItem>
                <CardItem cardBody>
                  <Image style={{ height: 300, flex: 1 }} source={item.image} />
                </CardItem>
                <CardItem>
                  <Text>{item.data}</Text>
                </CardItem>
              </Card>
            }
          />
        </View>
      </Container>
    );
  }
}