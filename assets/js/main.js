$(document).ready(function(){
    
var buttonGenerate = $('#button-addon2');
var enterURL       = $('.enter-url');
    
    buttonGenerate.click(function(){
       
       $('.alert').addClass('hidden-block');
        
       if($.trim(enterURL.val()) == ''){
           alert("Please enter URL")
       }
       else{
           
            $('#spinner').removeClass('hidden-block');
           
                $.post("ajaxHandler.php",
                {
                  sendurl: enterURL.val(),
                },
                function(data, status){
                    
                    $('#spinner').addClass('hidden-block');
                    
                    if(data + '' == 'false'){
                        $('.alert').removeClass('hidden-block');
                    }
                    else{
                        // Success
                        $('.url-block').hide();
                        $('.shortened_URL').removeClass('hidden-block');
                        var obj = $.parseJSON(data);
                        $('input[aria-describedby="button-addon3"]').val(obj['hash']);
                        $('#long_url').attr('href',obj['url']).text(obj['url']);
                    }
                });
       }
       
    });
    
    

   
});

    $('#button-addon3').bind('click', function() {
      var input = document.querySelector('#shortened_url');
      input.select(); 
      document.execCommand("copy");
    });
    
var exampleTriggerEl = document.getElementById('button-addon3')
var popover = bootstrap.Popover.getOrCreateInstance(exampleTriggerEl) 
