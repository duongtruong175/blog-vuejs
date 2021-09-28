const mutations = {
    updateUserAuth(state, newUser) {
        state.user = newUser;
    },
    updateLocale(state, newLocale) {
        state.locale = newLocale;
    }
};

export default mutations;
