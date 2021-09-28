const getters = {
    getUserAuth: (state) => {
        return state.user;
    },
    getLocale: (state) => {
        return state.locale;
    }
};

export default getters;
