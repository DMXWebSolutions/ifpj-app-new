import React, { Component } from 'react';
import { Header, Icon } from 'react-native-elements'
import { withNavigation } from 'react-navigation'

class HeaderMenu extends Component {
    constructor(props){
        super(props)
    }

    render() {
        return(
            <Header
                outerContainerStyles={{ borderBottomColor:'#444',borderBottomWidth:0.5 }}
                backgroundColor={'#f5f5f5'}
                statusBarProps={{ barStyle: 'dark-content'}}
                leftComponent={<Icon name='menu' color ='#999' onPress={ () => this.props.navigation.openDrawer() } />}
                centerComponent={{ text: this.props.title , style: { color: '#444', fontSize: 18, } }}
            />

        )
    }s
}

export default withNavigation(HeaderMenu)