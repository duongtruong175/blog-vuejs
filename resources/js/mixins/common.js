const common = {
    methods: {
        async callApi(method, url, dataObj) {
            try {
                const res = await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
                return res;
            } catch (error) {
                return error.response;
            }
        },
    }
};

export default common;