let userService;
let commentService;
let ideaService;

window.onload = config;
function config() {
    userService = new UserApi();
    commentService = new CommentApi();
    ideaService = new IdeaApi();
}
const commentContentEleId_prefix = 'commentContentEle';
const commentContentInput_prefix = 'commentContentInput';
