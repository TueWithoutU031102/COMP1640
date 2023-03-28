class CommentApi {
    constructor(id, content, author_id, idea_id, isAnonymous, created_at, updated_at) {
        this.id = id;
        this.content = content;
        this.author_id = author_id;
        this.idea_id = idea_id;
        this.isAnonymous = isAnonymous;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }

    commentOnIdea(ideaId, jwt, commentContent, isAnonymous) {
        let comment = new CommentApi()
        comment.idea_id = ideaId;
        comment.content = commentContent;
        comment.isAnonymous = isAnonymous;
        console.log("save: ", comment)
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            },
        }
        window.axios.post('/api/comments', comment, config)
            .then(function (response) {
                const commentsData = response.data;
                console.log("response add comment: ", commentsData);
            })
            .catch(function (error) {
                console.log(error);
            });
        comment.sentNotify(JSON.parse(localStorage.getItem('user')).name, ideaId, jwt);
    }

    sentNotify(from, ideaId, jwt) {
        let body = {
            from: from,
            idea_id: ideaId
        };
        let config = {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            },
        };
        console.log('sentNotify comment: ', body)
        window.axios.post('/api/send-email-comment', body, config)
            .then(function (response) {
                const commentsData = response.data;
                console.log("response send-email-comment: ", commentsData);
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
