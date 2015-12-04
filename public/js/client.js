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
			format: 'd mmmm yyyy',
			formatSubmit: 'yyyy-mmmm-d',
			hiddenName: 'creation_date',

	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 5 // Creates a dropdown of 15 years to control year
	  });

});
