class ApiClient {
    constructor() {
        this.baseUrl = '/api';      //every api request made by client will starts with /api
    }

    async getCsrfToken() {

        //1. Request CSRF Cookie from Laravel
        await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

        //2. extract token from cookies
        const token = document.cookie
            .split('; ')               //split cookies into array
            .find(row => row.startsWith('XSRF-TOKEN='))     //find the XSRF-TOKEN cookie
            ?.split('=')[1];           //get the value part


        //3. decode and return the token
        return token ? decodeURIComponent(token) : null;
    }


    async request(endpoint, options = {}) {

        //1. extract options with defaults GET
        const { method = 'GET', body, headers = {} } = options;

        //2. prepare headers
        const requestHeaders = {
            'Accept': 'application/json',       //tell server we expect JSON response
            ...headers                          //spread any additional headers
        };

        //3. Get CSRF token for other than GET request
        if (method !== 'GET') {
            const csrfToken = await this.getCsrfToken();
            if (csrfToken) {
                requestHeaders['X-XSRF-TOKEN'] = csrfToken;
            }

        }

        //4. Check if body is FormData - used for file uploads
        const isFormData = body instanceof FormData;

        //5. send actual HTTP request using Fetch API
        const response = await fetch(`${this.baseUrl}${endpoint}`, {
            method,
            credentials: 'include',
            headers: isFormData
                ? requestHeaders        //if FormData use requestHeaders onnly
                : { ...requestHeaders, 'Content-Type': 'application/json' },        //normal JSON request
            body: body
                ? (isFormData ? body : JSON.stringify(body))
                : undefined
        });

        //5.error handling
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        //6.parse and return JSON response
        return response.json();
    }

    //shortcuts for main HTTP methods
    async get(endpoint) {
        return this.request(endpoint, { method: 'GET' });
    }

    async post(endpoint, data) {
        return this.request(endpoint, { method: 'POST', body: data });
    }

    async put(endpoint, data) {
        return this.request(endpoint, { method: 'PUT', body: data });
    }

    async delete(endpoint) {
        return this.request(endpoint, { method: 'DELETE' });
    }
}

export default new ApiClient();     //one shared instance