 $(function() {

    $(function () {
      $('a[data-toggle="tooltip"]').tooltip();
    });

    $('#login').click(function(){
      
    	if (!$('#loginPanel').is(':visible')){
    		$('#cardGrid').hide();
    		$('#registerPanel').hide();
    		$('#loginPanel').fadeIn('slow');
            toggleMenuClasses();
    	}
    });
   
    $('#register').click(function(){
    	if (!$('#registerPanel').is(':visible')){
    		$('#cardGrid').hide();
    		$('#loginPanel').hide();
    		$('#registerPanel').fadeIn('slow');
            toggleMenuClasses();
    	}
    });
    

    $('#closeRegisterPanel').click(function(){
    	$('#registerPanel').hide();
    	$('#cardGrid').fadeIn();
        toggleMenuClasses();
    });
    $('#closeLoginPanel').click(function(){
    	$('#loginPanel').hide();
    	$('#cardGrid').fadeIn();
        toggleMenuClasses();
    });

    function toggleMenuClasses(){
        $('#menu-anunt').toggleClass('active');
        $('#menu-session').toggleClass('active');
    }

    $('#imageInput').on('change paste keyup', function () {
        var img = $('<img  />').load(function () {
            $("#imageHolder").empty().append(img);
        }).error(function () {
            //alert('broken image!');
        }).attr('src', $('#imageInput').val());
    });

    $('#updateUserSubmit').click(function (event) {

      event.preventDefault();// using this page stop being refreshing 

      $.ajax({
        type: 'POST',
        url: 'controller.php',
        data: $('form').serialize(),
        success: function (data) {
          console.log("OK->"+data);
          $('#actualisationOK').show().delay(5000).fadeOut();
        }
      });

    });

    $('.is-favorit').click(function(){

        var idAnunt = $(this).data('id');
        var isFavorit = $(this).data('favorit');
        event.preventDefault();// using this page stop being refreshing 

          $.ajax({
            type: 'GET',
            url: 'controller.php?actiune=favorit&idAnunt='+idAnunt+'&isFavorit='+isFavorit,
            //data: $('form').serialize(),
            success: function (data) {
                console.log("actualizare OK->"+data);
                
                if(isFavorit) {
                   
                    var element = $('a[data-id="'+idAnunt+'"]');
                    
                    element.text("").append("Favorit");
                } else {
                    var element = $('a[data-id="'+idAnunt+'"]');
                    element.text("").append("<span class='oi oi-check'></span>&nbsp;Favorit");    
                }
            }
          });
    })

  });