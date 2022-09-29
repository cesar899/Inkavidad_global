const API_URL = 'http://127.0.0.1:8000';

export default class {

    static getUrl(route) {
        return API_URL + '/' + route;
    }

}
