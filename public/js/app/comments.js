async function showCommentByIdea(ideaId, commentContentElementId) {
    let ideaService = new IdeaApi(ideaId);
    let userService = new UserApi();
    let jwt = window.localStorage.getItem('jwt');
    let comments = await ideaService.findCommentsByIdeaId(jwt);
    let commentContentEle = document.getElementById(commentContentElementId);
    let commentContent = '';

    for (const comment of comments) {
        userService.id = comment.author_id;
        let commentAuthor = await userService.findById();
        let imgSrc = '/'+commentAuthor.image;
        if (comment.isAnonymous){
            imgSrc = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Anonymous_emblem.svg/2048px-Anonymous_emblem.svg.png';
            commentAuthor.name = "Anonymous";
        }
        let created_at = comment.created_at.slice(0, 19);
        commentContent += `
        <div class="d-flex flex-start mt-4" style="gap: 10px">
    <img class="rounded-circle"
         src="${imgSrc}"
         alt="avatar" width="50" height="50"/>
    <div class="flex-grow-1 flex-shrink-1">
        <div
            style="
                                                    background: #a6dbf8;
                                                    border-radius: 20px;
                                                    padding: 10px 10px 10px 10px;
                                                    ">
            <div
                class="d-flex justify-content-between align-items-center"
                style="gap: 10px
                                                            ">
                <p class="mb-1">
                    <b>${commentAuthor.name}</b>
                </p>

            </div>
            <p class="small mb-0">
                ${comment.content}
            </p>
        </div>
        <div style="gap: 20px; display: flex">
            <a href="#!"><i class="fas fa-reply fa-xs"></i><span
                    class="small"> reply</span></a>
            <span class="small"
                  style="font-weight: bold">${created_at}</span>
        </div>

        <div id="sub-comment${comment.id}">
        </div>

    </div>
</div>
        `
    }
    commentContentEle.innerHTML = commentContent;
}

async function showuser(id) {
    console.log('id:', id)
    let user = await getUserById(id);
    console.log("show user: ", user)
    let src = '/' + user.image;
    document.getElementById('userEmail').innerHTML = src;
    document.getElementById('userImg').src = src;
}

async function getUserById(userID) {
    let userService = new UserApi();
    return await userService.findById(userID);
};

async function commentOnIdea(ideaId, userId, commentContentInput_Id) {
    let jwt = window.localStorage.getItem('jwt');
    let commentInput = document.getElementById(commentContentInput_Id);
    let isAnonymous = document.getElementById(commentAnonymous_prefix + ideaId).checked;
    let commentService = new CommentApi();

    if (commentInput.value === ''){
        alert('comment empty!');
        return;
    }

    commentService.commentOnIdea(ideaId, jwt, commentInput.value, isAnonymous);
    commentInput.value = '';
   await showCommentByIdea(ideaId, commentContentEleId_prefix + ideaId, isAnonymous);
}
