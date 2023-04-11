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
            resolveResponse(response.data.isLiked, showCountLikesEleId,showCountDislikesEleId, response);
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
            resolveResponse(response.data.isLiked, showCountLikesEleId,showCountDislikesEleId, response);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function resolveResponse(isLiked, showCountLikesEleId, showCountDislikesEleId, response) {
    document.getElementById(showCountLikesEleId).innerHTML = response.data.likes;
    document.getElementById(showCountDislikesEleId).innerHTML = response.data.dislikes;
    console.log(isLiked)
    if (isLiked) {
        console.log('like')
        $('#likes-interact').attr('class', 'fa-solid fa-thumbs-up fa-2x');
        $('#dislikes-interact').attr('class', 'fa-regular fa-thumbs-down fa-2x');
    } else {
        console.log('dislike')
        $('#dislikes-interact').attr('class', 'fa-solid fa-thumbs-down fa-2x');
        $('#likes-interact').attr('class', 'fa-regular fa-thumbs-up fa-2x');
    }
}
