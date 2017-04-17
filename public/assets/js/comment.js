/*
 * Copyright 2016 SPC Vietnam Co., Ltd.
 * All right reserved.
*/

/**
 * @Author: Nguyen Chat Hien
 * @Date:   2017-03-24 13:45:48
 * @Last Modified by:   Nguyen Chat Hien
 * @Last Modified time: 2017-04-03 11:09:51
 */

'use strict';
$('.laravelLike-icon').on('click', function(){
  if($(this).hasClass('disabled'))
    return false;

  var item_id = $(this).data('item-id');
  var vote = $(this).data('vote');

  $.ajax({
       method: "get",
       url: "/laravellikecomment/like/vote",
       data: {item_id: item_id, vote: vote},
       dataType: "json"
    })
    .done(function(msg){
      if(msg.flag == 1){
        if(msg.vote == 1){
          $('#'+item_id+'-like').removeClass('outline');
          $('#'+item_id+'-dislike').addClass('outline');
        }
        else if(msg.vote == -1){
          $('#'+item_id+'-dislike').removeClass('outline');
          $('#'+item_id+'-like').addClass('outline');
        }
        else if(msg.vote == 0){
          $('#'+item_id+'-like').addClass('outline');
          $('#'+item_id+'-dislike').addClass('outline');
        }
      $('#'+item_id+'-total-like').text(msg.totalLike == null ? 0 : msg.totalLike);
      $('#'+item_id+'-total-dislike').text(msg.totalDislike == null ? 0 : msg.totalDislike);
      }
    })
    .fail(function(msg){
      alert(msg);
    });
});


$(document).on('click', '.reply-button', function(){

    if($(this).hasClass("disabled"))
        return false;
    var toggle = $(this).data('toggle');
    $("#"+toggle).fadeToggle('normal');
});

$(document).on('click', '.btn-add-comment', function(e){

        e.preventDefault();

        var parent_id = $(this).data('parent');
        var question_id = $(this).data('item');
        var user_id = $(this).data('user');
        var comment_parent = $(this).parents('#write-comment-'+parent_id).first();
        var comment_form = $(this).parents('#answer-form-'+parent_id).first();
        var comment = $(comment_parent).find('textarea#'+parent_id+'-textarea').val().trim();

        //remove validation.
        $("#"+parent_id+"-textarea").css("border", "1px solid #ccc");
        $('.text-danger').remove();

        if(comment == '') {

            $("#"+parent_id+"-textarea").css('border', '1px solid red');
            comment_parent.after("<span class='text-danger' style='padding:3px 2px;float:left;'>Comment field is required.</span>");
            return false;
        }

        if(comment.length<3) {

            $("#"+parent_id+"-textarea").css('border', '1px solid red');
           comment_parent.after("<span class='text-danger' style='padding:3px 2px;float:left;'>The Comment must be at least 3 characters.</span>");
            return false;
        }

        $.ajax({
                url: "/answer/store",
                type:"POST",
                beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {

                                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                },
                data: {parent_id: parent_id, comment: comment, question_id: question_id, user_id: user_id},
                dataType: "json",
                success: function(data) {

                        //show message successfull
                        toastr.success( "Success", "Add comment" );

                        //hide answer form
                        if($('#answer-form-'+parent_id).hasClass('in')) $('#answer-form-'+parent_id).collapse('hide');

                        //create new data row answer
                        var sub_answer = '<div id="answer-form-'+data.answer.id+'" class="collapse"><div class="comment-user"><a href=""><img alt="image" class="avatar" src="/upload/users/'+data.user.avatar+'" width="44px;" style="border-radius: 3px;border-style: none;"></a></div><div class="col-lg-9 col-md-12 col-sm-12" style="padding-left: 60px;max-width: 100%;"><div class="panel panel-default comment"><div class="panel-heading" style="padding-bottom: 0px;"><ul class="nav nav-tabs" style="margin-bottom: -1px;"><li class="active"><a data-toggle="tab" href="#write-comment-'+data.answer.id+'" style="padding: 6px 15px;">Write</a></li><li><a data-toggle="tab" href="#pre-comment-'+data.answer.id+'" style="padding: 6px 15px;">Preview</a></li></ul></div><div class="panel-body"><div class="tab-content"><div id="write-comment-'+data.answer.id+'" class="tab-pane fade in active" style="padding-top: 0px;"><form action="" method="POST"><textarea id="'+data.answer.id+'-textarea" class="form-control" rows="5" required></textarea><button class="btn btn-success pull-right btn-add-comment" data-parent="'+data.answer.id+'" data-item= "'+data.question.id+'" data-user="'+data.user.id+'" style="margin-top: 15px;">Comment</button></form></div><div id="pre-comment-'+data.answer.id+'" class="tab-pane fade" style="padding-top: 0px;">Until now all of the examples were activated by the data attribute data-toggle="tab". The other approach you can use to activate Toggable Tabs/Pills is to use a script. The Bootstrap website gives the markup for this under the heading “Methods”.Below I show you an adapted version where I have used Pills instead of Tabs and where a pane is shown on hover instead of click:</div></div></div></div></div></div>'


                        var parentComment = '<div class="comment-post-'+data.answer.id +'"><div class="comment-user"><a href="/user/'+data.user.id+'/show"><img alt="image" class="avatar" src="/upload/users/'+data.user.avatar+'" width="44px;" style="border-radius: 3px;border-style: none;"></a></div><div class="col-lg-12 col-md-12 col-sm-12 comment-item" id="parent-answer-'+data.answer.id+'"><div class="panel panel-default comment"><div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i><a href="#"> SPCVN </a>commented 2 seconds ago<p class="pull-right"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 9  <i class="fa fa-comments-o" aria-hidden="true"></i>10 </p></div><div class="panel-body">'+data.answer.comment+'</br><a href="#answer-form-'+data.answer.id+'" class="reply-button" data-toggle="collapse">Reply</a></div></div>'+sub_answer+'<div class="clearfix"></div></div><div class="clearfix"></div></div>';

                        var subComment = '<div class="clearfix"></div><div class="comment-post-'+data.answer.id +'"><div class="comment-user"><a href="/user/'+data.user.id+'/show"><img alt="image" class="avatar" src="/upload/users/'+data.user.avatar+'" width="44px;" style="border-radius: 3px;border-style: none;"></a></div><div style="padding-left: 60px;"><div class="panel panel-default comment"><div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i><a href="#"> SPCVN </a>commented 2 seconds ago<p class="pull-right"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 9</p></div><div class="panel-body">'+data.answer.comment+'</div></div>'+sub_answer+'<div class="clearfix"></div></div><div class="clearfix"></div></div>';

                        if(parent_id === 0) {

                            $('.comment-post-'+parent_id).after(parentComment);
                        } else {

                            $('#answer-form-'+parent_id).after(subComment);
                        }

                        $('textarea#'+parent_id+'-textarea').val('');

                },error:function(msg){

                        //show message fail
                        toastr.error( "Fail!" , "Add comment" );
                }
        });
});


$(document).on('click', '#showComment', function(){

    var show = $(this).data("show-comment");
    $('.show-'+$(this).data("item-id")+'-'+show).fadeIn('normal');
    $(this).data("show-comment", show+1);
    $(this).text("Show more");
});

//preview comment
$('textarea#0-textarea').livePreview({

    previewElement: $('div#pre-comment-0'),
    allowedTags: ['p', 'strong', 'br', 'em', 'strike'],
    interval: 20
});

