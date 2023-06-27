import axios from 'axios';

class APIManager {
    static async fetchData(url, options = {}) {
        try {
            const response = await axios(url, options);
            return response.data;
        } catch (error) {
            console.error('API request failed:', error);
            throw error;
        }
    }
}

export default APIManager;
