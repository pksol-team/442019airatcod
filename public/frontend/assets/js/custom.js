jQuery(document).ready(function($) {

    // Croppie Jquery Plugin for profile picture upload and crop
    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
          width:145,
          height:165,
          type:'square' //circle
        },
        boundary:{
          width:200,
          height:200
        }
      });

      $('#upload_image').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
        $('#changeProfileModal').modal('hide');
        $('#uploadimageModal').modal('show');
      });

      $('.crop_image').click(function(event){
        $('.removeProfilePicture').remove();
        $('#uploadimageModal').modal('hide');
        var token = $('.csrf_token_profile').val();
        var user_id = $('.user_id').val();
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
          $.ajax({
            url:"/upload_profile_image",
            type: "POST",
            data:{"_token": token, "image": response, "user_id": user_id},
            success:function(data)
            {
              $('.doctor_profile_picture').attr('src', '/upload/'+data+'');
              $('<button class="f-size removeProfilePicture">Remove</button>').insertAfter('.doctor_profile_picture');
              $('#upload_image').val('');
            }
          });
        })
      });

    // Remove Profile Picture

    $(document).on('click', '.removeProfilePicture', function(e) {
        e.preventDefault();
        var $this = $(this);
        var user_id = $('.user_id').val();
        var token = $('.csrf_token_profile').val();
        $.ajax({
                type: 'POST',
                url: '/removeProfilePic',
                data: {"_token": token, 'user_id':user_id},
            })
            .done(function(response) {
              $('.doctor_profile_picture').attr('src', '/frontend/assets/img/default-doctor_1.png');
              $this.remove();
        });
    });

    //bootstrap Modal fiels empty after close modal
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find("textarea").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    })

    //Type Password Minimum length attribute add or delete
    $('.type_password').on('input', function(e) {
        var $this = $(this);
        if ($this.val() != '') {
            $this.attr('minlength', '5');
        } else {
            $this.removeAttr('minlength');
        }
    });

    // show hide Exract
    $('.modify_exract').on('click', function(e) {
        e.preventDefault();
        $('.dralia-form-exract').fadeIn();
        $('.dralia_para_exract').hide();
        $(this).hide();
    });

    // cancel button close Exract
    $('.cancel_data').on('click', function(e) {
        e.preventDefault();

        $('.dralia-form-exract').fadeOut();
        $('.dralia_para_exract').fadeIn();
        $('.modify_exract').show();
    });

    // Exract insert in Database
    $('.dralia-form-exract').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        var action = $this.attr('action');
        var commentData = $this.serializeArray();
        var exractValue = $('.dralia_exract_text').val();

        $.ajax({
                type: 'POST',
                url: action,
                data: commentData,
            })
            .done(function(response) {
                $('.dralia_para_exract').text(exractValue);
                $('.dralia-form-exract').fadeOut();
                $('.dralia_para_exract').fadeIn();
                $('.modify_exract').show();
            });
    });

    // Experience insert in Database
    $('.updateExperienceForm').on('submit', function(e) {
        e.preventDefault();
        var ExperienceValue = $('.AddDisease').val();
        if (ExperienceValue != '') {

            var newInput = `<li style="display:none;" data-key="newAdded">` + ExperienceValue + ` <a href="#" class="remove-exp">Remove</a>
                            <input type="hidden" value="` + ExperienceValue + `" name="data[Disease][]">
                          </li>`;
            $('.all_disease_list_doc').append(newInput);
            $('li[data-key=newAdded]').show('fast', function() {
                $(this).removeAttr('data-key');
            });;

            UpdateExperienceDisease('newAdded', '/updateExperience', '.formExperienceDisease');
            $('#AddExperienceModal').modal('hide');

        } else {
            $('.AddDisease').css({
                'border': 'solid 1px #e16f43',
                'outline': 'none',
                'box-shadow': 'none'
            });
        }
    });
    // Experience remove in Database
    $(document).on('click', '.remove-exp', function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent('li').fadeOut('slow', function() {
            $(this).remove();
            UpdateExperienceDisease('remove', '/updateExperience', '.formExperienceDisease');
        });
    });

    // Experience function
    function UpdateExperienceDisease(type, action, formName) {
         var previouseDisease = $(formName).serializeArray();
         $.post(action, previouseDisease).fail(function(){
            alert('Oops! something went wrong may be Error in your data please refresh and try again');
         });
    }

    // Show User Bio Section
    $('.modify_bio').on('click', function(e) {
        e.preventDefault();
        $('.user_image, .modify_bio_button, .RUT_number_li').hide();
        $('.modify_view_bio').removeClass('col-lg-9').addClass('col-lg-12');
        $('.edit-profile-form').show();
    });

    // Cancel Button User Bio Section
    $('.dralia-button-bio-cancel').on('click',  function(e) {
        e.preventDefault();
        hideBioSection();
    });

    // Hide  User Bio Function
    function hideBioSection(){
        $('.user_image, .modify_bio_button, .RUT_number_li').show();
        $('.modify_view_bio').removeClass('col-lg-12').addClass('col-lg-9');
        $('.edit-profile-form').hide();
    }


    // Update User Bio
    $('.dralia-form-bio-save').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        var action = $this.attr('action');
        var commentData = $this.serializeArray();

        $.ajax({
                type: 'POST',
                url: action,
                data: commentData,
            })
            .done(function(response) {
                hideBioSection();
                $('.RUT_number_default').text(commentData[3]['value']);
            });

    });

    // view about textarea
    $('.add_about').on('click', function(e) {
        e.preventDefault();
        $('.dralia-form-about').show();
        $(this).hide();
        $('.dralia_para_about').hide();
    });

    // view about textarea
    $('.cancel_about').on('click', function(e) {
        e.preventDefault();
        $('.dralia-form-about').hide();
        $('.dralia_para_about').fadeIn();
        $('.add_about').show();
    });

    // update about
    $('.dralia-form-about').on('submit',  function(e) {
        e.preventDefault();
        var $this = $(this);
        var action = $this.attr('action');
        var commentData = $this.serializeArray();
        var aboutValue = $('.dralia_about_text').val();

        $.ajax({
                type: 'POST',
                url: action,
                data: commentData,
            })
            .done(function(response) {
                $('.dralia_para_about').text(aboutValue).fadeIn();
                $('.dralia-form-about').hide();
                $('.add_about').show();
            });

    });

    // remove links error
    $('.link_title, .link_url').on('keyup', function(e) {
        e.preventDefault();
        $(this).css({
            'border': '1px solid #b6b6b6'
        }).siblings('.link_title_error').addClass('d-none');
    });

    //update Web Links
    $('.updateWebLinksForm').on('submit', function(e) {
        e.preventDefault();
        var webTitle = $('.link_title').val();
        var webLink = $('.link_url').val();
        if (webTitle != '' && webLink != '') {

            var newInput = `<li style="display:none;" data-key="newAddedLink">` + webTitle + `, `+webLink+` <a href="#" class="remove-link">Remove</a>
                            <input type="hidden" value="` + webTitle + `" name="data[webTitle][]">
                            <input type="hidden" value="` + webLink + `" name="data[webLinks][]">
                          </li>`;
            $('.user_links_list').append(newInput);
            $('li[data-key=newAddedLink]').show('fast', function() {
                $(this).removeAttr('data-key');
            });;

            UpdateExperienceDisease('newAddedLink', '/updateWebLinks', '.formWebLinks');
            
            $('.link_title').val('');
            $('.link_url').val('');

        } else {
            if (webTitle == '') {
                $('.link_title').css({
                    'border': 'solid 1px #e16f43',
                    'outline': 'none',
                    'box-shadow': 'none'
                }).siblings('.link_title_error').removeClass('d-none');
            }
            if( webLink == '') {
                $('.link_url').css({
                    'border': 'solid 1px #e16f43',
                    'outline': 'none',
                    'box-shadow': 'none'
                }).siblings('.link_title_error').removeClass('d-none');
            }
        }
    });

    // Web Link remove in Database
    $(document).on('click', '.remove-link', function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent('li').fadeOut('slow', function() {
            $(this).remove();
            UpdateExperienceDisease('newAddedLink', '/updateWebLinks', '.formWebLinks');
        });
    });

    $('.updateTrainingForm').on('submit', function(e) {
        e.preventDefault();
        var instName = $('.intstitute_name').val();
        var instYear = $('.intstitute_year').val();
        if (instName != '' && instYear != '') {

            var newInput = `<li style="display:none;" data-key="newAddedLink">` + instName + `, `+instYear+` <a href="#" class="remove-training">Remove</a>
                            <input type="hidden" value="` + instName + `" name="data[instName][]">
                            <input type="hidden" value="` + instYear + `" name="data[instYear][]">
                          </li>`;
            $('.user_links_list').append(newInput);
            $('li[data-key=newAddedLink]').show('fast', function() {
                $(this).removeAttr('data-key');
            });;

            UpdateExperienceDisease('newAddedLink', '/updateTraining', '.formTraining');
            
            $('.intstitute_name').val('');
            $('.intstitute_year').val('');

        } else {
            if (instName == '') {
                $('.intstitute_name').css({
                    'border': 'solid 1px #e16f43',
                    'outline': 'none',
                    'box-shadow': 'none'
                }).siblings('.training_title_error').removeClass('d-none');
            }
            if( instYear == '') {
                $('.intstitute_year').css({
                    'border': 'solid 1px #e16f43',
                    'outline': 'none',
                    'box-shadow': 'none'
                }).siblings('.training_title_error').removeClass('d-none');
            }
        }
    });

    // remove Training error
    $('.intstitute_name, .intstitute_year').on('keyup', function(e) {
        e.preventDefault();
        $(this).css({
            'border': '1px solid #b6b6b6'
        }).siblings('.training_title_error').addClass('d-none');
    });

    // Training remove in Database
    $(document).on('click', '.remove-training', function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent('li').fadeOut('slow', function() {
            $(this).remove();
            UpdateExperienceDisease('newAddedLink', '/updateTraining', '.formTraining');
        });
    });

    // Institute Year Picker Library
    $('.intstitute_year').yearpicker({
        autoHide: true,
        year: null
    });
   
    var fm_dropzone_main = null;
    fm_dropzone_main = new Dropzone("#fm_dropzone_main", {
        maxFilesize: 2,
        acceptedFiles: "image/*",
        init: function() {
            this.on("complete", function(file) {
                this.removeFile(file);
            });
            this.on("success", function(file) {
                console.log("addedfile");
                console.log(file);
                // loadUploadedFiles();
            });
        }
    });

});