function likeIdea(ideaId, showCountLikesEleId, showCountDislikesEleId) {
    let jwt = localStorage.getItem('jwt');
    let config = {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + jwt
        },
    }

    window.axios.post('/api/likeIdea/' + ideaId, '', config)
        .then(function (response) {
            resolveResponse(ideaId, response.data.isLiked, showCountLikesEleId, showCountDislikesEleId, response);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function dislikeIdea(ideaId, showCountLikesEleId, showCountDislikesEleId) {
    let jwt = localStorage.getItem('jwt');
    let config = {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + jwt
        },
    }

    window.axios.post('/api/dislikeIdea/' + ideaId, '', config)
        .then(function (response) {
            console.log(response.data)
            resolveResponse(ideaId, response.data.isLiked, showCountLikesEleId, showCountDislikesEleId, response);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function resolveResponse(ideaId, isLiked, showCountLikesEleId, showCountDislikesEleId, response) {
    document.getElementById(showCountLikesEleId).innerHTML = response.data.likes;
    document.getElementById(showCountDislikesEleId).innerHTML = response.data.dislikes;
    console.log(isLiked)
    let dislikesInteract = "dislikes-interact" + ideaId
    let likesInteract = "likes-interact" + ideaId
    if (isLiked) {
        document.getElementById(likesInteract).className = ('fa-solid fa-thumbs-up fa-2x');
    } else {
        document.getElementById(likesInteract).className = ('fa-regular fa-thumbs-up fa-2x');
    }

    console.log("dislike? ", response.data.isDisliked)

    response.data.isDisliked
        ? document.getElementById(dislikesInteract).className = ('fa-solid fa-thumbs-down fa-2x')
        : document.getElementById(dislikesInteract).className = ('fa-regular fa-thumbs-down fa-2x')

}


