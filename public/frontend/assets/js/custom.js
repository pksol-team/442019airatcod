jQuery(document).ready(function($) {
    // hide time filds for off day
    $('.close_day_button').change(function () {
        if ($(this).prop('checked') == false) {
            $('.location').removeAttr('required');
            $('.consulting_fields_main').hide();
        } else {
            $('.location').attr('required', 1);
            $('.consulting_fields_main').show();
        }
    });

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
            // console.log('jQuery bind complete');
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
              $('<button class="f-size removeProfilePicture">retirar</button>').insertAfter('.doctor_profile_picture');
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
        var previousDiseases = $('ul.all_disease_list_doc').find('li').length;
        if (ExperienceValue != '') {
            if (previousDiseases < 12) {

            var newInput = `<li style="display:none;" data-key="newAdded">` + ExperienceValue + ` <a href="#" class="remove-exp">retirar</a>
                            <input type="hidden" value="` + ExperienceValue + `" name="data[Disease][]">
                          </li>`;
            $('.all_disease_list_doc').append(newInput);
            $('li[data-key=newAdded]').show('fast', function() {
                $(this).removeAttr('data-key');
            });;

                UpdateExperienceDisease('newAdded', '/updateExperience', '.formExperienceDisease');
            } else {
                alert('Puede seleccionar hasta 12 enfermedades solamente');
            }
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
            alert('¡Uy! algo salió mal puede ser Error en sus datos, actualice e intente nuevamente');
         });
    }

    // Show User Bio Section
    $('.modify_bio').on('click', function(e) {
        e.preventDefault();
        $('.user_image, .modify_bio_button, .RUT_number_li, .specialty_li').hide();
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
        $('.user_image, .modify_bio_button, .RUT_number_li, .specialty_li').show();
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
        var previousLinks = $('ul.user_links_list').find('li').length;
        var webTitle = $('.link_title').val();
        var webLink = $('.link_url').val();
        if (webTitle != '' && webLink != '') {
            if (previousLinks < 3) {
                var newInput = `<li style="display:none;" data-key="newAddedLink">` + webTitle + `, `+webLink+` <a href="#" class="remove-link">retirar</a>
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
                alert('Puede agregar hasta 3 enlaces solamente');
            }

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

    // Update doctor training section
    $('.updateTrainingForm').on('submit', function(e) {
        e.preventDefault();
        var instName = $('.intstitute_name').val();
        var limit = $('.lim-typ-hidden').attr('data-lim');
        var previousTraining = $('ul.user_training_list').find('li').length;
        var instYear = $('.intstitute_year').val();
        if (instName != '' && instYear != '') {
            if (previousTraining < limit) {

            var newInput = `<li style="display:none;" data-key="newAddedLink">` + instName + `, `+instYear+` <a href="#" class="remove-training">retirar</a>
                            <input type="hidden" value="` + instName + `" name="data[instName][]">
                            <input type="hidden" value="` + instYear + `" name="data[instYear][]">
                          </li>`;
            $('.user_training_list').append(newInput);
            $('li[data-key=newAddedLink]').show('fast', function() {
                $(this).removeAttr('data-key');
            });;

            UpdateExperienceDisease('newAddedLink', '/updateTraining', '.formTraining');
            
            $('.intstitute_name').val('');
            $('.intstitute_year').val('');
            } else {
                alert('Puede agregar hasta '+ limit +' títulos o cursos');
            }

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

    // make doctor favourite if user login
    $('.make_favourite_heart').change(function () {
        var $this = $(this);
        var logincheck = $this.attr('data-user');
        var doctorID = $this.attr('data-doctor');
        var token = $this.attr('data-token');
        if ($this.prop('checked') == true) {
            if (logincheck != '0') {

                $.ajax({
                        type: 'POST',
                        url: '/make_fav',
                        data: {"_token": token, 'user_id':logincheck, 'doctor_id':doctorID},
                    })
                    .done(function(response) {
                        $this.prop('checked', true);
                    });

            } else {
                $this.prop('checked', false);
            }

        } else {
            $.ajax({
                    type: 'POST',
                    url: '/make_fav',
                    data: {"_token": token, 'user_id':logincheck, 'doctor_id':doctorID},
                })
                .done(function(response) {
                    $this.prop('checked', false);
                });
        }
    });

    // register radio button for professional or medico centr
    $('input[type=radio][name=selectprofession]').change(function() {
        if (this.value == 'medico') {
            $('.centro-medico.pro-reg-sec').removeClass('d-none');
            $('.centro-professional.pro-reg-sec').addClass('d-none');

        }
        else if (this.value == 'professional') {
            $('.centro-medico.pro-reg-sec').addClass('d-none');
            $('.centro-professional.pro-reg-sec').removeClass('d-none');
        }
    });

    // specialty combined in input
    $('input[name=selectspecialty]').change(function(e) {
        var selectedSpecialty = new Array();
        var selectedSpecialtyVal = new Array();
        $('input[name="selectspecialty"]:checked').each(function() {
            selectedSpecialty.push(this.value);
            selectedSpecialtyVal.push($(this).attr('data-name'));
        });
        if (selectedSpecialty.length != 0) {
            $('.specialty_array').val(selectedSpecialty);
            $('.specialtyName').val(selectedSpecialtyVal);
        } else {
            $('.specialty_array').val('');
        }
    });

    // specialty checked or not
    $('#postSpecialtyForm').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        var specialty = $('input[name=specialty]').val();
        if(specialty != '') {
            $this[0].submit();
        } else {
            alert('Por favor seleccione cualquier especialidad');
        }
    });

    // Remove Specialty with Ajax
    $(document).on('click', '.remove-speciality', function(e) {
        e.preventDefault();
        var $this = $(this);
        var specialty_id = $this.parent('li').attr('data-speciality_id');
        var specialty_name = $this.parent('li').attr('data-name');
        var token = $('.csrf_token_profile').val();
        var user_id = $('.user_id').val();

        $.ajax({
                type: 'POST',
                url:"/remove_specialty",
                data:{"_token": token, "specialty": specialty_id, "sub_specialty":specialty_name, "user_id": user_id},
            })
            .done(function(response) {
                if (response != 0) {
                    $this.parent('li').fadeOut('slow', function() {
                        $this.parent('li').remove();
                    });;
                    var alreadySpecialty = $('input[name=selectspecialty][value='+specialty_id+']');
                } else {
                    alert('¡Error! por lo menos 1 especialidad requerida');
                }
            });
    });

    // Add Specialty on view profile page
    $('.updateSpecialtyFormProfile').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        var specialty = $('input[name=specialty]').val();
        var sub_specialty = $('input[name=specialtyName]').val();
        var user_id = $('.user_id').val();
        var token = $('.csrf_token_profile').val();
        if(specialty != '') {
                    $.each(specialty.split(','), function(index, val) {
                        var field = $('.all_specialties_modal').find(".selectspecialty-modal[value='"+val+"']").next('h6').html();
                        var append = '<li data-name="'+field+'" data-speciality_id="'+val+'">'+field+' -- <a href="#" class="remove-speciality"> retirar</a></li>';
                        $('ul.specialty_exists').append(append);
                        $('.all_specialties_modal').find(".selectspecialty-modal[value='"+val+"']").parent('li').remove();

                    });
            $.ajax({
                    type: 'POST',
                    url:"/addSpecialty",
                    data:{"_token": token, "specialty": specialty, "sub_specialty":sub_specialty, "user_id": user_id},
                })
                .done(function(response) {
                    $('#speciality_modal_close').trigger('click');
                });
            
        } else {
            alert('Por favor seleccione cualquier especialidad');
        }
    });

    // datatable in doctore profile view for daily timings
    $("#available_times").DataTable({
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "ordering": false,
        "pageLength": 15,
        "language": {
            url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
    });

    // Experience insert in Database
    $('.updateServiceForm').on('submit', function(e) {
        e.preventDefault();
        var serviceValue = $('#addService').val();
        var serviceRate = $('#addRate').val();
        if (serviceValue != '') {

            var newInput = `<tr style="display:none;" data-key="newAdded">
                              <td>`+serviceValue+` </td><td class="text-center">$ `+serviceRate+`</td><td><a href="#" class="remove-service">Borrar</a>
                              </td>
                              <input type="hidden" value="`+serviceValue+`" name="data[service][]" />
                              <input type="hidden" value="`+serviceRate+`" name="data[rate][]" />
                            </tr>`;
            $('.all_services_tbody').append(newInput);
            $('tr[data-key=newAdded]').show('fast', function() {
                $(this).removeAttr('data-key');
                UpdateExperienceDisease('newAdded', '/addService', '.formServices');
            });

            $('#addServicesRates').modal('hide');
            $('#addServicesRates.modal input').val('');

        } else {
            $('#addService').css({
                'border': 'solid 1px #e16f43',
                'outline': 'none',
                'box-shadow': 'none'
            });
        }
    });

    // Remove Service in Database
    $(document).on('click', '.remove-service', function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent().parent().fadeOut('slow', function() {
            $(this).remove();
            UpdateExperienceDisease('remove', '/addService', '.formServices');
        });
    });

    // Show doctor contact Number
    $('.see_phone_profile').on('click',  function(e) {
        e.preventDefault();
        $(this).hide();
        $('.phone_number_show').removeClass('d-none');
    });

    // home Page Search form submit empty
    $('.homePageSearch').on('submit',  function(e) {
        e.preventDefault();
        var specialtySelect = $('.searchByInput').val();
        if (specialtySelect != '') {
            $(this)[0].submit();
        }
    });

    // Doctor page search
    $('.doctorsPageSearch').on('submit',  function(e) {
        e.preventDefault();
        var specialtySelect = $('.searchBySpecialty').val();
        var citySelect = $('.searchByCity').val();
        var forecastSelect = $('.searchByForecast').val();
        if (specialtySelect == '' && citySelect == '' && forecastSelect == '') {
        } else {
            $(this)[0].submit();
        }
    });

    //show forecast form
    $('.modify_forecast').on('click',  function(e) {
        e.preventDefault();
        $('.updateForecast').removeClass('d-none');
        $('.forecastShowing').addClass('d-none');
    });

    //hide forecast form
    $('#forecast_close').on('click',  function(e) {
        e.preventDefault();
        $('.updateForecast').addClass('d-none');
        $('.forecastShowing').removeClass('d-none');
    });

    // Add/update Forecast
    $('.updateForecast').on('submit', function(e) {
        e.preventDefault();
        var radioValue = $("input[name='forecast']:checked").val();
        var token = $('.csrf_token_profile').val();
        var user_id = $('.user_id').val();
        if (radioValue != undefined) {

            $.ajax({
                    type: 'POST',
                    url:"/addForecast",
                    data:{"_token": token, "forecast": radioValue, "user_id": user_id},
                })
                .done(function(response) {
                    $('.updateForecast').addClass('d-none');
                    $('.forecastShowing').text(radioValue).removeClass('d-none');
                });
            
        } else {
            alert('Seleccione cualquier pronóstico');
        }
    });

    // select 2
    $('.js-example-basic-single').select2();
    $('.specialty_quote').select2();
    $('.summernote_detail').summernote({
        height: 300,
        popover: {
        image: [],
        link: [],
        air: []
        }
        });

    // Summer Note empty error show

    $('.addNewArticle').on('submit', function(e) {
      
      if($('.summernote_detail').summernote('isEmpty')) {
        alert('El contenido está vacío, llénalo!');

        // cancel submit
        e.preventDefault();
      }
      else {
      }
    })
    
});