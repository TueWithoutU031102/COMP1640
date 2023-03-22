console.log(new UserApi())
console.log(new IdeaApi())

const commentContent =
    `<div className="d-flex flex-start mt-4" style="gap: 10px">
        <img className="rounded-circle"
             src="{{asset($comment->user->image)}}"
             alt="avatar" width="50" height="50"/>
        <div className="flex-grow-1 flex-shrink-1">
            <div
                style="
                                                    background: #a6dbf8;
                                                    border-radius: 20px;
                                                    padding: 10px 10px 10px 10px;
                                                    ">
                <div
                    className="d-flex justify-content-between align-items-center"
                    style="gap: 10px
                                                            ">
                    <p className="mb-1">
                        <b>{{$comment->user->name}}</b>
                    </p>

                </div>
                <p className="small mb-0">
                    {{$comment->content}}
                </p>
            </div>
            <div style="gap: 20px; display: flex">
                <a href="#!"><i className="fas fa-reply fa-xs"></i><span
                    className="small"> reply</span></a>
                <span className="small"
                      style="font-weight: bold">2 hours ago</span>
            </div>

            <div className="d-flex flex-start mt-4">
                <a className="me-3" href="#">
                    <img className="rounded-circle"
                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                         alt="avatar" width="50" height="50"/>
                </a>
                <div className="flex-grow-1 flex-shrink-1">
                    <div
                        style="
                                                    background: #a6dbf8;
                                                    border-radius: 20px;
                                                    padding: 10px 10px 10px 10px;
                                                    ">
                        <div
                            className="d-flex justify-content-between align-items-center">
                            <p className="mb-1">
                                <b>Simona Disa</b>
                            </p>
                        </div>
                        <p className="small mb-0">
                            letters, as opposed to using 'Content
                            here, content here',
                            making it look like readable English.
                        </p>
                    </div>
                    <span className="small" style="font-weight: bold">2 hours
                                                                ago</span>
                </div>
            </div>
        </div>
    </div>`


async function showCommentByIdea(ideaId, commentContentElementId) {
    ideaService = new IdeaApi(ideaId);
    userService = new UserApi();
    let jwt = window.localStorage.getItem('jwt');
    let comments = await ideaService.findCommentsByIdeaId(jwt);
    let commentContentEle = document.getElementById(commentContentElementId);
    let commentContent = '';
    let commentAuthor = new UserApi();

    for (const comment of comments) {
        console.log(comment)
        let created_at = comment.created_at.slice(0,19);
        commentAuthor = await userService.findById(comment.author_id);
        commentContent += `
        <div class="d-flex flex-start mt-4" style="gap: 10px">
    <img class="rounded-circle"
         src="/${commentAuthor.image}"
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
        <!--<div class="d-flex flex-start mt-4">-->
        <!--            <a class="me-3" href="#">-->
        <!--                <img class="rounded-circle"-->
        <!--                     src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"-->
        <!--                     alt="avatar" width="50" height="50"/>-->
        <!--            </a>-->
        <!--            <div class="flex-grow-1 flex-shrink-1">-->
        <!--                <div-->
        <!--                    style="-->
        <!--                                                    background: #a6dbf8;-->
        <!--                                                    border-radius: 20px;-->
        <!--                                                    padding: 10px 10px 10px 10px;-->
        <!--                                                    ">-->
        <!--                    <div-->
        <!--                        class="d-flex justify-content-between align-items-center">-->
        <!--                        <p class="mb-1">-->
        <!--                            <b>Simona Disa</b>-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                    <p class="small mb-0">-->
        <!--                        letters, as opposed to using 'Content-->
        <!--                        here, content here',-->
        <!--                        making it look like readable English.-->
        <!--                    </p>-->
        <!--                </div>-->
        <!--                <span class="small" style="font-weight: bold">2 hours-->
        <!--                                                                ago</span>-->
        <!--            </div>-->
        <!--        </div>-->
        </div>

    </div>
</div>
        `
    }
    console.log('id:', commentContentElementId)
    console.log(commentContentEle)
    commentContentEle.innerHTML = commentContent;
};

async function showuser(id) {
    console.log('id:', id)
    let user = await getUserByid(id);
    console.log("show user: ", user)
    let src = '/' + user.image;
    document.getElementById('userEmail').innerHTML = src;
    document.getElementById('userImg').src = src;
}

async function getUserByid(userID) {
    let userService = new UserApi();
    return await userService.findById(userID);
};

async function commentOnIdea(ideaId, userId) {
    let jwt = window.localStorage.getItem('jwt');
    console.log(ideaId, "|uId - ", userId, "|token - ", jwt)

    let commentContent = document.getElementById(commentContentInput_prefix + ideaId).value;
    console.log("comment: ", commentContent)

    let commentService = new CommentApi();
    await commentService.commentOnIdea(ideaId, jwt, commentContent);

    await showCommentByIdea(ideaId, commentContentEleId_prefix+ideaId);
}
