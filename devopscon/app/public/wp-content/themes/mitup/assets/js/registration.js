(function( $ ){

    'use strict';

    $(document).ready(function(){

        var check = 'true'; 



        // Date Field
        $('form.ovatheme_form input.input-date').each(function(){
                var datepickerid = $(this).data('idunique');
                $('#'+datepickerid).datepicker({
                    dateFormat : $(this).attr("data-format")
                });
        });

        // validate and process form

        $('form.ovatheme_form .submit-button').off('click').on('click', function (e) {

            var idform = $(this).data('idform');
            var iduniform = $("#"+idform);

            if(iduniform.closest('.slide_register_form').length > 0){
                iduniform = $('.owl-item.active #'+idform);
            }

            iduniform.find('.get_data').each(function(){

                    var value = $(this).val().trim();
                    var data_placeholder = $(this).data('placeholder');

                    // Check text and textarea empty
                    if( ( $(this).hasClass('input-text') || $(this).hasClass('input-textarea') || $(this).hasClass('input-date') || ($(this).hasClass('bootstrap-select')) ) && $(this).hasClass('require') ){

                        
                        // Check if element is select
                        if( $(this).hasClass('bootstrap-select') ){
                            if( $(this).find('.selectpicker').selectpicker('val')  == ''){

                                    $(this).find('.selectpicker').tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                                    $(this).focus();    
                                    check = 'false';
                                    return false;

                            }else{
                                $(this).find('.selectpicker').tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                                check = 'true';
                                return true;
                            }
                        }else{
                              if( value == '' || value == data_placeholder ){

                                    $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                                    $(this).focus();    
                                    check = 'false';
                                    return false;  

                              } else{
                                    $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                                    check = 'true';
                                    return true;
                              }                             
                        }


                    }

                    // Check email syntax
                    if( ( $(this).hasClass('input-email') && $(this).hasClass('require') ) || ( $(this).hasClass('input-email') && value != '' ) ){
                        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                        if (!pattern.test(value)) {
                            $(this).focus();
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                            check = 'false';
                            return false;
                        }else{
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                            check = 'true';                        
                        }
                    }

                    // Check Url syntax
                    if( ( $(this).hasClass('input-url') && $(this).hasClass('require') ) || ( $(this).hasClass('input-url') && value != '' ) ){
                        var filter_url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                        if (!filter_url.test(value)) {
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                            $(this).focus();
                            check = 'false';
                            return false;
                        }else{
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                            check = 'true';                        
                        }
                    }

                    // Check Number syntax
                    if( ( $(this).hasClass('input-number') && $(this).hasClass('require') ) || ( $(this).hasClass('input-number') && value != '' ) ){
                        var filter_phone = /^[0-9-+]+$/;
                        if (!filter_phone.test(value)) {
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                            $(this).focus();
                            check = 'false';
                            return false;
                        }else{
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                            check = 'true';                        
                        }
                    }

            }); 

        
            if(check == 'false'){
                e.preventDefault();
                return false;
            }
            e.preventDefault();

           


            var customer_info    = '';
            var label_field  = '';
            var value_field  = '';
            
            
            // Get userinfo that user put in form register
            var customer_id =  iduniform.find('input.customer').val();
            var register_type = iduniform.find('input.register_type').val();

            var customer_email = '';
            iduniform.find('.get_data').each(function(){
                if( $(this).hasClass('input-email') ){
                    customer_email = $(this).val();        
                }
                
            });
            
            

            iduniform.find('.get_data').each(function(){
                label_field = '';
                value_field = '';

                if ($(this).attr('type') == 'checkbox'){
                    if($(this).is(":checked")){
                        label_field = $(this).attr('name');
                        value_field = $(this).val();
                    }
                    
                }else if ($(this).attr('type') == 'radio'){
                    if($(this).is(":checked")){
                        label_field = $(this).attr('name');
                        value_field = $(this).val();     
                    }
                }else if( $(this).hasClass('bootstrap-select') == false ){
                    label_field = $(this).attr('data-place');
                    value_field = $(this).val();    
                }

                var regex = /(<([^>]+)>)/ig;
                var value_field_new = value_field.replace(regex, "");

                if(label_field != '' && value_field != ''){
                    customer_info = customer_info +'<strong>'+label_field +'</strong>:'+value_field_new+ '<br/><i>|||</i>';     
                }
               
            });

            $(this).prop("disabled",true);
            iduniform.find('.event_loading').addClass('show');

            
            var currency = '';
            var price = '';
            var ticket = '';

            if(register_type == 'pay'){
                currency = iduniform.find('.currency').val();
                price = iduniform.find('.selectpicker.input-price').val();
                ticket = iduniform.find('.selectpicker.input-ticket').val();
            }

            // Store register to register list
            $.post(ajax_object.ajaxurl, {
                action: 'ajax_action',
                data: {
                    customer_info:customer_info,                
                    customer_id: customer_id,
                    register_type: register_type,
                    customer_email: customer_email,
                    currency: currency,
                    price: price,
                    ticket: ticket
                }
            }, function(reponse) {
                if(reponse == 'true'){
                    if(iduniform.find('input.register_type').val() == 'pay'){
                        iduniform.submit();
                        return false;    
                    }else{
                        /* Register free */
                        iduniform.find('.form-alert').append('' +
                        '<div class=\"alert alert-success registration-form-alert fade in\">' +
                        '<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>' +
                        iduniform.find('.register_success_msg').val() +
                        '</div>' +
                        '');
                        
                        iduniform[0].reset();
                        iduniform.find('.form-control').focus().blur();

                        iduniform.find('.submit-button').prop("disabled",false);
                        iduniform.find('.event_loading').removeClass('show');
                    }
                    
                        
                }else{
                   iduniform.find('.form-alert').append('' +
                        '<div class=\"alert alert-error registration-form-alert fade in\">' +
                        '<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>' +
                        '<strong>Registering is error!</strong>.' +
                        '</div>' +
                        '');
                   return false;
                }
            });

               
        });

        

    });

})(jQuery); 