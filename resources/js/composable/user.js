import {onMounted, ref} from "vue";

export default function useUser() {

    const user = ref({});

    const me = () => {
        axios({
            method: 'GET',
            url: `/api/me`,
        }).then(response => {
            user.value = response.data.user;
        }).catch(err => {
            console.log(err);
        })
    }

    const login = (data) => {
        axios({
            method: 'POST',
            url: '/api/login',
            data: data
        }).then(response => {
            localStorage = response.data.token;
        }).catch(err => {
            console.log(err);
        })
    }

    const register = (data) => {
        axios({
            method: 'POST',
            url: '/api/register',
            data: data
        }).then(response => {
            user.value = response.data;
        }).catch(err => {
            console.log(err);
        })
    }

    onMounted(() => {
        me();
    })

    return {
        user,
        me,
        login,
        register
    }
}
