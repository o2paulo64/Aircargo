(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready

  $(document).ready(function(){
      $('.parallax').parallax();
    });

   $(document).ready(function() {
    $('select').material_select();
  });

   $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });


 $('#textarea1').trigger('autoresize');
        
})(jQuery); // end of jQuery name space