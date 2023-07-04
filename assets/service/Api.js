import axios from 'axios';

const url = window.location.href
const domain = url.split('/')[2]

class APIManager {
    static async fetchData(url, options = {}) {
        try {
            const response = await axios(`http://${domain}${url}`, options)
            return response.data;
        } catch (error) {
            console.error('API request failed:', error);
            throw error;
        }
    }
}

export default APIManager;
