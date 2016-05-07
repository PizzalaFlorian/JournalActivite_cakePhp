$(document).ready(function() {
   
   // Lorsque l'on clique sur show on affiche la fenêtre modale
   $('#Lundi').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Lundi');
   });
   
   $('#Mardi').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Mardi');
   });
   
   $('#Mercredi').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Mercredi');
   });
   
   $('#Jeudi').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Jeudi');
   });
   
   $('#Vendredi').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Vendredi');
   });
   
   $('#Samedi').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Samedi');
   });
   
   $('#Dimanche').click(function (e) {
       //On désactive le comportement du lien
        e.preventDefault();
      showModal('Dimanche');
   });
   
   // Lorsque l'on clique sur le fond on cache la fenetre modale   
   $('#fond').click(function () {
      hideModal();
    });
   
   // Lorsque l'on modifie la taille du navigateur la taille du fond change
   $(window).resize(function () {
      resizeModal()
   });
 
});


function showModal(J){
   var id = '#modal';
   var content = 'ajouter une activité '+J+'<br/><form action="Activite.recorder.php" method="post"><p>Votre nom : <input type="text" name="nom" /></p><p>Votre âge : <input type="text" name="age" /></p><p><input type="submit" value="OK"></p></form><a href="#" class="close">Fermer la fenetre</a>';
   
   $(id).html(content);
   // On definit la taille de la fenetre modale
   resizeModal();
   
   // Effet de transition     
   $(id).fadeIn(5);
   
   $('.popup .close').click(function (e) {
      // On désactive le comportement du lien
      e.preventDefault();
      // On cache la fenetre modale
      hideModal();
    });
}


function hideModal(){
   // On cache le fond et la fenêtre modale
   $('#fond, .popup').hide();
   $('.popup').html('');
}

function resizeModal(){
   var modal = $('#modal');
   // On récupère la largeur de l'écran et la hauteur de la page afin de cacher la totalité de l'écran
   var winH = $(document).height();
   var winW = $(window).width();
   
   // le fond aura la taille de l'écran
   $('#fond').css({'width':winW,'height':winH});
   
   // On récupère la hauteur et la largeur de l'écran
   var winH = $(window).height();
   // On met la fenêtre modale au centre de l'écran
   modal.css('top', winH/2 - modal.height()/2);
   modal.css('left', winW/2 - modal.width()/2);
}
