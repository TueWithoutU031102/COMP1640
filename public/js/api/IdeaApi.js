
class IdeaApi {
    title
    description
    category_id
    submission_id
    author_id
    created_at
    updated_at
    constructor(id) {
        this.id = id
    }

    async findCommentsByIdeaId(jwt){
        let result = [];
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            },
        }
        await window.axios.get('/api/comments/findCommentsByIdeaId/' + this.id, config)
            .then(function (response) {
                const commentsData = response.data.comments;
                commentsData.forEach(function(data) {
                    result.push(new CommentApi(data.id, data.content, data.author_id, data.idea_id, data.created_at, data.updated_at ));
                });
            })
            .catch(function (error) {
                console.log(error);
            });
        return result;
    };

    sentSubmitIdeaNotify(from, submissionId, jwt){
        let body = {
            from:from,
            submissionId:submissionId
        };
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            },
        };
        window.axios.post('/api/send-email-submitIdea', body, config)
            .then(function (response) {
                const submitIdeaResponse = response.data;
                console.log("response send-email-submitIdea: ", submitIdeaResponse);
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
