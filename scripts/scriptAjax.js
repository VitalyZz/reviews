$(document).ready(function() {
    $('.authorization_submit').on('click', function(event) {
        event.preventDefault();

        let emailValue = $('input.authorization_email').val();
        let passwordValue = $('input.authorization_password').val();
        let tokenValue = $('input.authorization_token').val();

        let url = "../backend/authorization.php";
        let data = {
            email: emailValue,
            password: passwordValue,
            _token: tokenValue
        };

        ajaxFunc(url, data);
    });

    $('.registration_submit').on('click', function(event) {
        event.preventDefault();

        let nameValue = $('input.registration_name').val();
        let emailValue = $('input.registration_email').val();
        let passwordValue = $('input.registration_password').val();
        let passwordConfirmValue = $('input.registration_confirm_password').val();
        let consentValue = $('input.registration_consent').is(':checked') === true ? 'Yes' : 'No';
        let tokenValue = $('input.registration_token').val();

        let url = "../backend/registration.php";
        let data = {
                name: nameValue,
                email: emailValue,
                password: passwordValue,
                confirm_password: passwordConfirmValue,
                consent: consentValue,
                _token: tokenValue
         };

        ajaxFunc(url, data);
    });

    $('.createCommentBtn').on('click', function(event) {
        event.preventDefault();

        let textValue = $('textarea.createComment_text').val();
        let idValue = $('input.createComment_id_review').val();
        let tokenValue = $('input.createComment_token').val();

        let url = "../backend/createComment.php";
        let data = {
            text: textValue,
            id_review: idValue,
            _token: tokenValue
        };

        $.ajax({
            method: "POST",
            url: url,
            data: data,
            success: function(result) {
                $('.error_comment').text(result['message']).css({color:'#65fe1a'});
                $('.comments').load('../review.php .comments > *')
                $('#anchorComment')[0].reset();
            },
            error: function(result) {
                $('.error_comment').text(result.responseJSON).css({color:'#FF6464'});
            }
        });
    });

    $('.addReviewBtn').on('click', function(event) {
        event.preventDefault();

        let nameValue = $('input.createReview_name').val();
        let textValue = $('textarea.createReview_text').val();
        let trailerValue = $('input.createReview_trailer').val();
        let tokenValue = $('input.createReview_token').val();

        let url = "../backend/createReview.php";

        let fd = new FormData();
        fd.append('poster', $('input.createReview_poster')[0].files[0]);
        fd.append('name', nameValue);
        fd.append('text', textValue);
        fd.append('trailer', trailerValue);
        fd.append('_token', tokenValue);

        $.ajax({
            url: url,
            data: fd,
            processData: false,
            contentType: false,
            method: 'POST',
            success: function(result) {
                console.log('success', result);
                $('.errors_output1').show();
                $('.errors_output_header1').text('Поздравляю!').css({backgroundColor: '#39af00'});
                $('.errors_output_text1').text(result).css({color:'#65fe1a'});

                $('.createReviewForm')[0].reset();
                $('span.custom-text').text("Постер не выбран").css({color: '#aaa'});
            },
            error: function(result) {
                console.log('error', result);
                $('.errors_output1').show();
                $('.errors_output_header1').text('Ошибка!').css({backgroundColor: '#FF6464'});
                $('.errors_output_text1').text(result.responseJSON).css({color:'#FF6464'});
            }
        });
    });
});