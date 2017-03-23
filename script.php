function formValidation() {
	var mdp1 = document.inscription.pass;
	var mdp2 = document.inscription.confipass;
	var pren = document.inscription.prenom;
	var nm = document.inscription.nom;

	if (QueDesLettres(pren)){
		if (QueDesLettres(nm)){
			if (MDP_Confirme(mdp1,mdp2)) {}
		}
	}
	return false;
}

function connexion(nb){
   if (nb==1){
       var pass = document.connexion.pass;
       surligne(pass,true);
       alert ('Adresse mail ou mot de passe incorrect');
   }
    if (nb==2){
       var pass = document.inscription.email;
        surligne(pass,true);
        alert ('Adresse mail déjà utilisée');
   }

}

function surligne(champ,erreur)
{
   if(erreur){
      champ.style.backgroundColor = "#fba";
      $('champ').append('yolo');
    }
   else
      champ.style.backgroundColor = "";
}


function MDP_Confirme(mdp1, mdp2) {

    if (mdp1.value != mdp2.value) {
        alert('Mot de passe differrents');
        mdp2.focus();
        surligne(mdp2, true);
        return false;
    }
    else{
    surligne(conf, false);
    return true;
     }

}

function QueDesLettres(mot) {
    var lettre = /^[A-Za-z]+$/;
    if (mot.value.match(lettre)) {
        surligne(mot, false);
        return true;
    } else {

        alert('Ce champ ne peut comprendre que des lettres');
        mot.focus();
        surligne(mot, true);
        return false;
    }
}


function get_orientation(src){
		var someImg = $("#someId");
		if (someImg.width() > someImg.height()){
				//it's a landscape
				return "landscape";
		} else if (someImg.width() < someImg.height()){
				//it's a portrait
				return "portrait";
		} else {
				//image width and height are equal, therefore it is square.
				return "landscape";
		}
}

$(document).ready(function() {
		//Le code ici
		jQuery(function($){
				//Lorsque vous cliquez sur un lien de la classe poplight
				$('.poplight').on('click', function() {
						var popID = $(this).data('rel'); //Trouver la pop-up correspondante
						var popWidth = $(this).data('width'); //Trouver la largeur

						//Faire apparaitre la pop-up et ajouter le bouton de fermeture
						$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');

						//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
						var popMargTop = ($('#' + popID).height() + 80) / 2;
						var popMargLeft = ($('#' + popID).width() + 80) / 2;

						//Apply Margin to Popup
						$('#' + popID).css({
								'margin-top' : -popMargTop,
								'margin-left' : -popMargLeft
						});

						//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
						$('body').append('<div id="fade"></div>');
						$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

						return false;
				});


				//Close Popups and Fade Layer
				$('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
						$('#fade , .popup_block').fadeOut(function() {
								$('#fade, a.close').remove();
				}); //...ils disparaissent ensemble

						return false;
				});
		});
});


$(document).ready(function(){

   $("#setting").click(function() {
   		if($("#menu_set").is(":hidden")){
            $("body").append('<div id="fade2"></div>');
            $('#fade2').fadeIn();
   			$("#menu_set").slideDown('slow');

   		}
    });

    $('body').on('click', '#fade2', function(){
        $('#fade2').fadeOut('slow');
        $("#menu_set").slideUp('slow');

    });

});


$(document).ready(function(){

   $("#import").click(function() {
   		if($("#dandd").is(":hidden")){
            $("body").append('<div id="fade"></div>');
            $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
   			$("#dandd").fadeIn();

   		}
    });

    $('body').on('click', '#fade, #quidd', function(){
        $('#fade , #dandd').fadeOut('slow')
    });

});


$(document).ready(function(){

   $("#catego").click(function() {
   		if($('#chth' ).is(":hidden")){
            $("body").append('<div id="fade2"></div>');
            $('#fade2').fadeIn();
   			$("#chth").slideDown('slow');

   		}
    });

    $('body').on('click', '#fade2', function(){
        $('#fade2').fadeOut('slow');
        $("#chth").slideUp('slow');

    });

});

function chargeGallerie() {
    document.getElementById("field2").value = document.getElementById("field1").value;
}


function supprim(){
    if(confirm('Voulez vous supprimer ce profil ?'))
        return true;
    else return false;
}

$(document).ready(function(){

		<?php
   $(".adminprivi").on('click', function() {
var adminID = $(this).data('id');
            $("body").append('<div id="fade"></div>');
            $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
   			$("#"+adminID).fadeIn();

    });

    $('body').on('click', '#fade', function(){
        $('#fade , .choix_admin').fadeOut('slow')

    });

});

$(document).ready(function(){

   $("#addprof").click(function() {
   		if($("#ajoutprof").is(":hidden")){
            $("body").append('<div id="fade"></div>');
            $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
   			$("#ajoutprof").fadeIn();

   		}
    });

    $('body').on('click', '#fade', function(){
        $('#fade , #ajoutprof').fadeOut('slow')
    });

});
