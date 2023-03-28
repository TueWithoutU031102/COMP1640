class UserApi {

    constructor(id, name, email, phone_number, DoB, image, role_id) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.phone_number = phone_number;
        this.DoB = DoB;
        this.image = image;
        this.role_id = role_id;
    }


    async findById() {
        let result = new UserApi();

        await window.axios.get('/api/users/' + this.id)
            .then(function (response) {
                const userData = response.data.user
                result = new UserApi(userData.id, userData.name, userData.email, userData.phone_number,
                    userData.DoB, userData.image, userData.role_id);
            })
            .catch(function (error) {
                console.log(error);
            });
        return result;
    }
    async findUserByJWT(jwt) {
        let result;
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            },
        }
        await window.axios.get('/api/getUserByToken',config)
            .then(function (response) {
                const userData = response.data.user
                result = new UserApi(userData.id, userData.name, userData.email, userData.phone_number,
                    userData.DoB, userData.image, userData.role_id);
            })
            .catch(function (error) {
                console.log(error);
            });
        return result;
    }
}
