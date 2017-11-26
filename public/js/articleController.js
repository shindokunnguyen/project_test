var ArticleController = {

	CheckClickLike : 0,
	ArticleLike : function () {
		if (ArticleController.CheckClickLike == 1) return;
		ArticleController.CheckClickLike = 1;

		var like_value = $('#like_value').val();
		var like_new_value = '';
		var art_id = $('#art_id').val();
		var user_id = $('#user_id').val();
		if (like_value == 1) {
			$('#un_like_btn').hide();
			$('#like_btn').show();
			$('#like_value').val(0);
			like_new_value = 0;
		} else {
			$('#un_like_btn').show();
			$('#like_btn').hide();
			$('#like_value').val(1);
			like_new_value = 1;
		}

		$.ajax ({
			type: 'post',
            url: APP_URL+'/like/updatelike',
            data: {
                '_token': $('input[name=_token]').val(),
                'like_new_value' : like_new_value,
				'art_id' : art_id,
				'user_id' : user_id
            },

			'dataType' : 'json',
			success: function (data){
				
				ArticleController.CheckClickLike = 0;
			}
		});
	},

	CheckClickOpenOvl : 0,
	OpenOVLCommnet: function () {
		if (ArticleController.CheckClickOpenOvl == 1) return;
		ArticleController.CheckClickOpenOvl = 1;

		$('#footer_action_button').text("Comment");
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Comment about to Article');
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('name'));
        $('#myModal').modal('show');

        ArticleController.CheckClickOpenOvl = 0;
	},

	CheckClickComment : 0,
	Comment : function () {
		if (ArticleController.CheckClickComment == 1) return;
		ArticleController.CheckClickComment = 1;

		var art_id = $('#art_id').val();
		var content = $('#content').val();

		if (content == '') {
			alert ('Please enter the text into the comment box');
			ArticleController.CheckClickComment = 0;
			return;
		}

		$.ajax({
            type: 'post',
            url: APP_URL+'/comment/add',
            data: {
                '_token': $('input[name=_token]').val(),
                'art_id': art_id,
                'content': content
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                	$('#alert-success').html('');
                	$('#alert-success').show();
                	$('#alert-success').html('Comment added success !!');
                }
                ArticleController.LoadComment(art_id);
                ArticleController.CheckClickComment = 0;
            }
        });
	},

	LoadComment : function (art_id) {
		$.ajax({
			url: APP_URL+'/comment/loadcomment',
			type: 'post',
			data: {
				'_token': $('input[name=_token]').val(),
				'art_id' : art_id
			},
			dataType: 'json',
			success: function (data){
				if (data.status == 1) {
					$('#list-comment').html (data.html);
				}
			}
		});
	}
};