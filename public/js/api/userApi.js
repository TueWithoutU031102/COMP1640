class UserApi {

    constructor(id, name, email, phone_number, dob, image, role_id) {
        this.id = id;
        this.name = name;
        this.phone_number = phone_number;
        this.dob = dob;
        this.image = image;
        this.role_id = role_id;
    }


    findById(userId) {
        window.axios.get('/api/users/' + userId)
            .then(function (response) {
                const obj = response.data.user

                console.log(obj);
                let user = new UserApi(obj.id, obj.name, obj.phone_number,
                                        obj.dob, obj.image, obj.role_id);
                console.log("user class ",user)
                return user;
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
