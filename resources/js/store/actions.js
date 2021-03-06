const actions = {
    async loadUser({ commit }) {
        const url = "/getUserAuth";
        const res = await axios({
            method: "get",
            url: url
        });
        if (res.status === 200) {
            commit("updateUserAuth", res.data.user);
            localStorage.setItem('userAuth', JSON.stringify(res.data.user));
        }
    }
};

export default actions;
