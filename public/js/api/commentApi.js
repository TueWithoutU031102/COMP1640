class CommentApi{
    constructor(id,content, author_id, idea_id, created_at, updated_at) {
        this.id = id;
        this.content = content;
        this.author_id = author_id;
        this.idea_id = idea_id;
        this.created_at = created_at;
        this.updated_at = updated_at;
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
