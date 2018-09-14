import { AsyncStorage } from 'react-native';
import { create } from 'apisauce';

const api = create({
    // baseURL: 'https://ifpj-backend.herokuapp.com',
    baseURL: 'https://ifpj-api.atualldigital.com.br/'
});

api.addResponseTransform(response => {
    if (!response.ok) throw response;
});

api.addAsyncRequestTransform( request => async () => {
    const token = await AsyncStorage.getItem('@CodeApi:token');

    if(token) 
        request.headers['x-access-token'] = token;
    
});

export default api;