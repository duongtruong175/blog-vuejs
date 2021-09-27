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
        formatDateTimeAgo(dateTime) {
            let seconds = Math.floor((new Date() - new Date(dateTime)) / 1000);

            let interval = seconds / 31536000;

            if (interval > 1) {
                return Math.floor(interval) + " years ago";
            }
            interval = seconds / 2592000;
            if (interval > 1) {
                return Math.floor(interval) + " months ago";
            }
            interval = seconds / 86400;
            if (interval > 1) {
                return Math.floor(interval) + " days ago";
            }
            interval = seconds / 3600;
            if (interval > 1) {
                return Math.floor(interval) + " hours ago";
            }
            interval = seconds / 60;
            if (interval > 1) {
                return Math.floor(interval) + " minutes ago";
            }
            if (interval === 1) {
                return "just now";
            }
            return Math.floor(seconds) + " seconds ago";
        },
        formatDateTime(dateTime) {
            return new Date(dateTime).toLocaleString();
        }
    }
};

export default common;