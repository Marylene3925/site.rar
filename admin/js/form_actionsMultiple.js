
//traite une action de masse à effectuer sur une sélection d'enregistrements
//action : supprimer, masquer, publier
function traiteFormActionsMulti (action) {
	
	if (action == 'Supprimer' || action == 'Masquer' || action == 'Publier' ) {
		
		//on renseigne un champ hidden sur l'action à effectuer sur les enregistrements
		document.getElementById('hiddenActionMulti').value = action;

		if (confirm('Vous etes sur le point de ' + action + ' des enregistrements en masse. \nEtes vous sûr de vouloir continuer ?')) {

			//on poste le formulaire
			document.forms["formActionMulti"].submit();
		}
		

	} else {

		alert('traiteFormActionsMulti : paramètre inattendu !!')
		return false;
	}


	
	return true;
}