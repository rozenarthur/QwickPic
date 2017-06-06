$(document).ready(function()
{
      $('#sidebar_btn').click(function()
      {//when the button is sidebar button is clicked
          //add the class visible to the sidebar so it appears using css
          $('#sidebar').toggleClass('visible');

      });

      $('#close').click(function()
      {//when the close button is clicked
          //add the class collapase to the sidebar so it collapses using css
          $('#sidebar').toggleClass('visible');

      });

      $('#drop').change(function()
      {//when the drop down option is changed
        var sel = $(this).val(); //gets the new album that is selected
        $.post('qwickPic_album_sort.php', {drop: sel}, function(data){
            $('#your_img').hide();
            $('#your_img2').html(data);
        });//end post
      });//end function change

}); //end jquery
