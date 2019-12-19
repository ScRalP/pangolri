const $ = require('jquery');

var slideIndex = 0;
showSlides(slideIndex);


//Handle clic prev
$prev = $('#slideshow_prev').click(function(e){
  slideIndex -= 1
  showSlides(slideIndex)
});

//Handle clic next
$next = $('#slideshow_next').click(function(e){
  slideIndex += 1
  showSlides(slideIndex)
});

//Display image
function showSlides() {
  var $slides = $('.mySlides')

  //Si on dépasse le nb images
  if (slideIndex >= $slides.length) {
    slideIndex = 0
  }
  //Si on descends sous l'image 1
  if (slideIndex < 0) {
    slideIndex = $slides.length-1
  }

  //Mettre toute les images à none
  for (i = 0; i < $slides.length; i++) {
    $slides[i].style.display = "none"
  }

  console.log(slideIndex)
  $slides[slideIndex].style.display = "block"

} 