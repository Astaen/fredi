$(document).ready(function() {

		// Datepicker de la boite modale
	  $('.datepicker').pickadate({
			// Strings and translations
			monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
			monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
			weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
			weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],

			// Buttons
			today: 'Auj',
			clear: 'Effacer',
			close: 'Fermer',

			// Accessibility labels
			labelMonthNext: 'Mois suivant',
			labelMonthPrev: 'Mois précédent',
			labelMonthSelect: 'Sélectionner un mois',
			labelYearSelect: 'Sélectionner une année',

			// Formats
			format: 'dd/mm/yyyy',
			formatSubmit: 'yyyy-mm-dd',
			hiddenName: 'creation_date',
			hiddenSuffix: '',

		    selectMonths: true,
		    yearSelector: true,
		    selectYears: 100
	  });

	  $('select').material_select();

	  $('#fee_type').change(function() {
	  	var feetype = $('#fee_type').val();
	  	switch(feetype) {
	  		case 'default':
	  			$('#add_fee #amount').attr("placeholder", "Montant en euro");
	  			break;
	  		case 'km':
	  			$('#add_fee #amount').attr("placeholder", "Distance en km");
	  			break;
	  	}
	  	if(feetype == 'km') {
	  		$("span.after-input.fee-type").text('km');
	  	} else {
	  		$("span.after-input.fee-type").text('€');
	  	}
	  });

	 // $('.edit_fee').click(function(e) {

	 // 	var id = $(this).attr("data-id");
	 // 	$.ajax({
	 // 		url: '/fee/'+id,
	 // 		type: 'GET'
	 // 	})
	 // 	.done(function(msg) {
	 // 		$('#edit_fee #id_fee').val(msg.id_fee);
	 // 		$('#edit_fee #caption').val(msg.caption);
	 // 		$('#edit_fee #fee_type').children().each(function(index, el) {
	 // 			if($(el).val() == msg.id_fee_type) {
	 // 				$(el).prop("selected", true);
	 // 				$('select').material_select();
	 // 			}
	 // 		});
	 // 		$('#edit_fee #creation_date').val(msg.creation_date);
	 // 		$('#edit_fee #amount').val(msg.amount);

		//   	switch(msg.id_fee_type) {
		//   		case 'default':
		//   			$('#edit_fee #amount').attr("placeholder", "Montant en euro");
		//   			break;
		//   		case 'km':
		//   			$('#edit_fee #amount').attr("placeholder", "Distance en km");
		//   			break;
		//   	}
		//   	$('#edit_fee').openModal();
	 // 	})
	 // 	.fail(function() {
	 // 		Materialize.toast('Erreur serveur, impossible de récupérer le frais.', 4000);
	 // 	});

	 // })

	 //Envoi du formulaire d'édition du frais
	 $('#edit_fee button.submit').click(function(e) {
	 	var fee = {
	 		id_fee : $('#edit_fee #id_fee').val(),
	 		id_fee_type : $('#edit_fee #fee_type').val(),
	 		creation_date : $('#edit_fee #creation_date').val(),
	 		caption : $('#edit_fee #caption').val(),
	 		amount : $('#edit_fee #amount').val()
	 	}
	 	console.log("POST :");
	 	console.log(fee);
	 	$.ajax({
	 		url: '/fee/'+fee.id_fee+'/edit',
	 		type: 'POST',
	 		data: fee
	 	})
	 	.done(function(msg) {
	 		if(msg.err) {
	 			Materialize.toast('Erreur serveur, impossible de mettre à jour le frais.', 4000);
	 		} else {
	 			var interval = setInterval(function(){
	 				// window.location.reload();
	 			}, 150);
	 		}
	 	})
	 	.fail(function() {
	 		Materialize.toast('Erreur serveur, impossible de mettre à jour le frais.', 4000);
	 	});
	});

	var $window = $(window);
	// Vérifie la taille de l'écran, et active le menu pour les mobiles/tablettes
	if($window.width() <= 992) {
		$(".button-collapse").sideNav();
	} else {
		$('.dropdown-button').dropdown();
	}
	// Ecoute le redimenssionnement de la fenetre
	$window.resize(function() {
		// Si écran mobile/tablette
	  if($window.width() <= 992) {
			$(".button-collapse").sideNav();
		}
	});
});
