const state = {
    user: JSON.parse(localStorage.getItem("userAuth")) || {},
    locale: "en"
};

export default state;
