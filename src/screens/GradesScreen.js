import React, { Component } from 'react';
import { AsyncStorage, FlatList } from 'react-native'
import { Header } from 'react-native-elements'
import { Container, Content, List, ListItem, Text, Separator, Left, Button, Title, Icon , Body} from 'native-base';
import api from '../services/api';


export default class GradesScreen extends Component {
  constructor(props){
    super(props)
    this.state = {
      disciplina: '',
      grades: ''
    }
  }
  
  async componentDidMount() {

    let namedisc = this.props.navigation.getParam('disciplina', 'Disciplina')
    let coddisc = this.props.navigation.getParam('coddisc', 'Codigo')
    
    const user = JSON.parse(await AsyncStorage.getItem('@CodeApi:user'))
    const userRegister = user.register
    
    const response = await api.get(`/bolletin/${userRegister}/${coddisc}`)

    const grades = response.data.Grades
    
    this.setState({disciplina: namedisc, grades: grades})
    
  }

  backPage() {
    this.props.navigation.goBack()
  }

  verifyGrades(code) {

    switch(code) {
      case '01': 
        return '1º TRIMESTRE'
      case '02': 
        return '2º TRIMESTRE'
      case '03': 
        return '3º TRIMESTRE'
      case '10': 
        return '1º RECUPERAÇÃO'
      case '11': 
        return '2º RECUPERAÇÃO'
      default:
        return 'SEM NOTAS'
    }
  }
  
  render() {

    console.log(this.state.grades)

    return (
      <Container>
        <Header
          outerContainerStyles={{ borderBottomColor:'#444',borderBottomWidth:0.5 }}
          backgroundColor={'#f5f5f5'}
          statusBarProps={{ barStyle: 'dark-content'}}
          leftComponent={<Icon name='md-arrow-round-back' color ='#999' onPress={ () => this.props.navigation.navigate('Boletim') } />}
          centerComponent={{ text: this.state.disciplina , style: { color: '#444', fontSize: 18, } }}
        />
        <Content>
          <FlatList
            data={this.state.grades}
            renderItem={(grade) => (

              <Content>
                <Separator bordered>
                  <Text>{this.verifyGrades(grade.item.codverifi)}</Text>
                </Separator>

                <ListItem>
                  <Text>P1: {grade.item.p1}</Text>
                </ListItem>

                <ListItem>
                  <Text>P2: {grade.item.p2}</Text>
                </ListItem>

                <ListItem>
                  <Text>Trabalho: {grade.item.trabalho}</Text>
                </ListItem>

                <ListItem>
                  <Text>PS: {grade.item.ps}</Text>
                </ListItem>

                <ListItem>
                  <Text>Conceito: {grade.item.conc}</Text>
                </ListItem>

                <ListItem>
                  <Text>Simulado: {grade.item.simulado}</Text>
                </ListItem>

                <ListItem>
                  <Text>Projeto: {grade.item.projeto}</Text>
                </ListItem>

                <ListItem>
                  <Text>Final: {grade.item.total}</Text>
                </ListItem>
              </Content>


            )}
            keyExtractor={(item, index) => index.toString()}
          />
        </Content>
      </Container>
    );
  }
}