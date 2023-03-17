
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

    async findCommentsByIdeaId(){
        let result = new Array();
        await window.axios.get('/api/comments/findCommentsByIdeaId/' + this.id)
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
    }

    async commentOnIdea(ideaId, jwt, commentContent){
        let body = new CommentApi()
        body.idea_id = ideaId;
        body.content = commentContent;
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            },
        }
        await window.axios.post('/api/comments', body, config)
            .then(function (response) {
                const commentsData = response.data.comment;
                console.log("response add comment: ", commentsData);
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
