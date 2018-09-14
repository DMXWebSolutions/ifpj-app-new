import React, { Component } from 'react';
import { AsyncStorage, FlatList } from 'react-native'
import { Container, Content, List, ListItem, Text, Left, Right, Icon} from 'native-base';
import { Root } from "native-base";
import { withNavigation } from 'react-navigation';

import api from '../services/api';

class DisciplineScreen extends Component {
  constructor(props){
    super(props)
    this.state = {
      disciplines: ''
    }
  }

  async componentDidMount(){
    const user = JSON.parse(await AsyncStorage.getItem('@CodeApi:user'));
    if(user) {
      this.setState({ user })
    }
    const classroom = user.classroom
    console.log(classroom)
    const response = await api.get(`/classrooms/disciplines/221A`)
    console.log(response.data)
    const disciplines = response.data.disciplines
    console.log(disciplines)
    this.setState({disciplines}) 
  }

  disciplineGrades(discipline) {
    this.props.navigation.navigate('Grades', {
      disciplina: discipline.nomedisc,
      coddisc: discipline.coddisc
    });
  }

  render() {
    return (
      <Root>
        <Container>
          <Content>
            <List>
              <FlatList
                data={this.state.disciplines}
                renderItem={(disciplina) => (
                  <ListItem button onPress={() => {this.disciplineGrades(disciplina.item)}}>
                    <Left>
                      <Text>{disciplina.item.nomedisc}</Text>
                    </Left>

                    <Right>
                      <Icon name="arrow-forward" />
                    </Right>
                  </ListItem>
                  
                )}
                keyExtractor={(item, index) => index.toString()}
              />
            </List>
          </Content>
        </Container>
      </Root>
    );
  }
}

export default withNavigation(DisciplineScreen)