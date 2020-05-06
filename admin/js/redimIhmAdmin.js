function redimIhmAdmin() {

	elemMenu = document.getElementById('menu');
	elemFooter = document.getElementById('footer');
	elemContenu = document.getElementById('contenu');



	nMenuHauteur = parseInt(elemMenu.offsetHeight) + parseInt(elemMenu.offsetTop);
	nFooterHauteur = parseInt(elemFooter.offsetTop);


	if (nMenuHauteur + 5 > nFooterHauteur) {
		elemContenu.style.height = (nMenuHauteur - parseInt(elemFooter.offsetHeight)) + 'px';
	}


}


//window.onload = redimIhmAdmin;