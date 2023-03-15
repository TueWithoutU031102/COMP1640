class CommentApi{
    constructor(id,content, author_id, idea_id) {
        this.id = id;
        this.content = content;
        this.author_id = author_id;
        this.idea_id = idea_id;
    }

    async findCommentsByIdeaId(ideaId){
        let result = new Array();
        await window.axios.get('/api/comments/findCommentsByIdeaId/' + ideaId)
            .then(function (response) {
                const commentsData = response.data.comments;
                commentsData.forEach(function(data) {
                    result.push(new CommentApi(data.id, data.content, data.author_id, data.idea_id));
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
