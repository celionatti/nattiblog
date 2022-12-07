$(document).ready(function () {

    convertTime = (time) => {
        return new Date(time).toLocaleDateString('en-us', {
            year: "numeric",
            month: "short",
            day: "numeric"
        })
    }

    // View All Replies.
    $(document).on('click', '.view_reply_btn', function (e) {
        e.preventDefault();

        var thisClicked = $(this);
        var comment_id = thisClicked.val();

        $.ajax({
            type: "POST",
            url: "/admin/viewCommentReplies",
            data: {
                'comment_id': comment_id,
                'view_comment_data': true
            },
            success: function (response) {
                $(".reply_section").html("");

                $.each(response, function (key, value) { 
                   thisClicked.closest(".reply_box").find(".reply_section").append(
                  '<div class="sub_reply_box border-bottom p-2 mb-2">\
                    <input type="hidden" class="get_username" value="'+ value['username'] +'"/>\
                    <h6 class="border-bottom d-inline">'+ value['username'] +' <span class="float-end"><i class="bi bi-clock"></i> '+ convertTime(value['created_at']) +'</span></h6>\
                    <p class="params">'+ value['reply_msg'] +'</p>\
                    <button onclick="deleteReply('+ value['id'] +')" class="btn btn-sm btn-danger delete_reply_btn">Delete</button>\
                    </div>\
                    ');  
                });
            }
        });
    });
    

    // End.
});
